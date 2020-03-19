<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Budget_model extends MY_Model
{
  protected $table = "budget";
  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'budget_id' );
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
   * budget
   *
   *
   * @return static
   * @author madukubah
   */
  public function budgets( $start = 0 , $limit = NULL )
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
   * budget
   *
   *
   * @return static
   * @author madukubah
   */
  public function budget_by_activity_id( $activity_id,  $status = 0, $year=NULL )
  {
      $rpm_pln = NULL;
      $this->db->where( 'activity.id', $activity_id);
      $this->db->group_by( 'activity.id');
      return $this->sum( 0 , NULL, NULL, $year, NULL, $status, $rpm_pln );
  }

   /**
   * budget
   *
   *
   * @return static
   * @author madukubah
   */
  public function planning_budgets( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL )
  {
      $this->db->group_by( 'activity.id');
      return $this->sum( $start , $limit, $nomenclature_id , $year , $pptk_id );
  }

  public function realization_budgets( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL )
  {
      $this->db->group_by( 'activity.id');
      return $this->sum( $start , $limit, $nomenclature_id , $year , $pptk_id, $status = 1 );
  }
  
  /**
   * budget
   *
   *
   * @return static
   * @author madukubah
   */
  public function sum( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL, $status = 0, $rpm_pln = NULL, $activity_id = NULL )
  {
        $year || $year = date('Y');
        $this->db->select([
          "nomenclature.id as nomenclature_id",
          "nomenclature.code",
          "nomenclature.name",
          "activity.*",
          // "'F' as AuFnF",
          "'F' as AUpLkS",
          "sum( activity.total ) as total",
          "SUM( activity.jan ) as jan",
          "SUM( activity.feb ) as feb",
          "SUM( activity.mar ) as mar",
          "SUM( activity.apr ) as apr",
          "SUM( activity.mei ) as mei",
          "SUM( activity.jun ) as jun",
          "SUM( activity.jul ) as jul",
          "SUM( activity.ags ) as ags",
          "SUM( activity.sep ) as sep",
          "SUM( activity.okt ) as okt",
          "SUM( activity.nov ) as nov",
          "SUM( activity.des ) as des", 
        ]);
        $this->db->from( 
          '
            (
              SELECT 
                    activity.*,
                    ( activity.ceiling_rpm + activity.ceiling_pln ) as total,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 1 THEN  budget.nominal ELSE 0 end  ) as jan,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 2 THEN  budget.nominal ELSE 0 end  ) as feb,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 3 THEN  budget.nominal ELSE 0 end  ) as mar,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 4 THEN  budget.nominal ELSE 0 end  ) as apr,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 5 THEN  budget.nominal ELSE 0 end  ) as mei,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 6 THEN  budget.nominal ELSE 0 end  ) as jun,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 7 THEN  budget.nominal ELSE 0 end  ) as jul,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 8 THEN  budget.nominal ELSE 0 end  ) as ags,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 9 THEN  budget.nominal ELSE 0 end  ) as sep,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 10 THEN  budget.nominal ELSE 0 end  ) as okt,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 11 THEN  budget.nominal ELSE 0 end  ) as nov,
                    SUM( CASE WHEN budget.status = '.$status.' AND budget.month = 12 THEN  budget.nominal ELSE 0 end  ) as des
                From 
                    activity
                INNER JOIN
                    budget
                on 
                    budget.activity_id = activity.id
            '.
            $a = (  ( isset( $rpm_pln ) ) ? "WHERE budget.rpm_pln = ".$rpm_pln : "" )
            .'
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
        if ( isset( $activity_id ) )
            $this->db->where( 'activity.id', $activity_id);
        
        // $this->db->group_by( 'activity.id');

        return $this->db->get(  );
  }

}
?>
