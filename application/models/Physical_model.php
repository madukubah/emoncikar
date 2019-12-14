<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Physical_model extends MY_Model
{
  protected $table = "physical";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'physical_id' );
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create( $data )
  {

      // Filter the data passed
      $data = $this->_filter_data($this->table, $data);

      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id($this->table . '_id_seq');
    
      if( isset($id) )
      {
        $this->set_message("berhasil");
        return $id;
      }
      $this->set_error("gagal");
          return FALSE;
  }

   /**
   * create_batch
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create_batch( $entries )
  {
      // echo var_dump( $entries )."<br><br>";die;
      if( empty( $entries ) ) return TRUE;
      
      $this->db->trans_begin();
      
      $this->db->insert_batch( $this->table , $entries);

      if ($this->db->trans_status() === FALSE)
      {
        $this->db->trans_rollback();

        $this->set_error("gagal");
        return FALSE;
      }

      $this->db->trans_commit();

      $this->set_message("berhasil");
      return TRUE;
  }

  /**
   * update
   *
   * @param array  $data
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function update( $data, $data_param  )
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");
    return TRUE;
  }
  /**
   * delete
   *
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function delete( $data_param  )
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    if( !$this->delete_foreign( $data_param ) )
    {
      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('group_delete_successful');
    return TRUE;
  }

    /**
   * group
   *
   * @param int|array|null $id = id_physical
   * @return static
   * @author madukubah
   */
  // public function physical( $id = NULL  )
  // {
  //     if (isset($id))
  //     {
  //       $this->where($this->table.'.id', $id);
  //     }

  //     $this->limit(1);
  //     $this->order_by($this->table.'.id', 'desc');

  //     $this->physicals(  );

  //     return $this;
  // }

  /**
   * physical
   *
   *
   * @return static
   * @author madukubah
   */
  public function physicals( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

   /**
   * physical
   *
   *
   * @return static
   * @author madukubah
   */
  public function planning_physicals( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL )
  {
      $this->db->group_by( 'activity.id');
      return $this->sum( $start , $limit, $nomenclature_id , $year , $pptk_id );
  }

  public function physical_by_activity_id( $activity_id,  $status = 0  )
  {

    $this->db->where( 'activity.id', $activity_id);
    $this->db->group_by( 'activity.id');
    return $this->sum( 0 , NULL,NULL, NULL,NULL, $status );
  }

  /**
   * physical
   *
   *
   * @return static
   * @author madukubah
   */
  public function sum( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL, $status = 0 )
  {
      $year || $year = date('Y');
        $this->db->select([
          "nomenclature.id as nomenclature_id",
          "nomenclature.code",
          "nomenclature.name",
          "activity.*",
          "'F' as AuFnF",
          "'F' as AUpLkS",
          "sum( activity.total ) as total",
          "sum( 100 ) as progress_total",
          "SUM( activity.jan ) / sum( 100 ) * 100 as jan",
          "SUM( activity.feb ) / sum( 100 ) * 100 as feb",
          "SUM( activity.mar ) / sum( 100 ) * 100 as mar",
          "SUM( activity.apr ) / sum( 100 ) * 100 as apr",
          "SUM( activity.mei ) / sum( 100 ) * 100 as mei",
          "SUM( activity.jun ) / sum( 100 ) * 100 as jun",
          "SUM( activity.jul ) / sum( 100 ) * 100 as jul",
          "SUM( activity.ags ) / sum( 100 ) * 100 as ags",
          "SUM( activity.sep ) / sum( 100 ) * 100 as sep",
          "SUM( activity.okt ) / sum( 100 ) * 100 as okt",
          "SUM( activity.nov ) / sum( 100 ) * 100 as nov",
          "SUM( activity.des ) / sum( 100 ) * 100 as des",
        ]);
        $this->db->from( 
          '
            (
              SELECT 
                    activity.*,
                    ( activity.ceiling_rpm + activity.ceiling_pln ) as total,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 1 THEN  physical.progress ELSE 0 end  ) as jan,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 2 THEN  physical.progress ELSE 0 end  ) as feb,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 3 THEN  physical.progress ELSE 0 end  ) as mar,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 4 THEN  physical.progress ELSE 0 end  ) as apr,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 5 THEN  physical.progress ELSE 0 end  ) as mei,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 6 THEN  physical.progress ELSE 0 end  ) as jun,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 7 THEN  physical.progress ELSE 0 end  ) as jul,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 8 THEN  physical.progress ELSE 0 end  ) as ags,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 9 THEN  physical.progress ELSE 0 end  ) as sep,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 10 THEN  physical.progress ELSE 0 end  ) as okt,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 11 THEN  physical.progress ELSE 0 end  ) as nov,
                    SUM( CASE WHEN physical.status = '.$status.' AND physical.month = 12 THEN  physical.progress ELSE 0 end  ) as des
                From 
                    activity
                INNER JOIN
                    physical
                on 
                    physical.activity_id = activity.id
            GROUP BY activity.id        
            ) activity
          '
        );
        $this->db->join( "nomenclature","on nomenclature.id = activity.nomenclature_id", "inner" );

        if ( isset( $year ) )
            $this->db->where( 'activity.year', $year);
        if ( isset( $nomenclature_id ) )
            $this->db->where( 'nomenclature_id', $nomenclature_id);
        if ( isset( $pptk_id ) )
            $this->db->where( 'pptk_id', $pptk_id);
        
        // $this->db->group_by( 'activity.id');

        return $this->db->get(  );
  }

}
?>
