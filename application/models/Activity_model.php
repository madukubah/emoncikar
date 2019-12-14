<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends MY_Model
{
  protected $table = "activity";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'activity_id' );
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
   * @param int|array|null $id = id_activity
   * @return static
   * @author madukubah
   */
  public function activity( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->_fetch_data(  );

      return $this;
  }

   /**
   * groups
   *
   *
   * @return static
   * @author madukubah
   */
  public function _fetch_data( $start = 0 , $limit = NULL )
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
   * activity
   *
   *
   * @return static
   * @author madukubah
   */
  public function activities( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL )
  {
    $this->db->group_by( 'activity.id');
    return $this->sum( $start, $limit, $nomenclature_id , $year , $pptk_id );
  }
  /**
   * activity
   *
   *
   * @return static
   * @author madukubah
   */
  public function sum( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL )
  {
      $year || $year = date('Y');
      $this->db->select([
        "nomenclature.id as nomenclature_id",
        "nomenclature.code",
        "nomenclature.name",
        "activity.*",
        "'F' as AuFnF",
        "'F' as AUpLkS",
        "SUM( quantity ) as quantity",
        "SUM( activity.ceiling_rpm + activity.ceiling_pln ) as total",
        "SUM( ceiling_rpm ) as ceiling_rpm",
        "SUM( ceiling_pln ) as ceiling_pln",
        "SUM( real_rpm + real_pln ) as real_total",
        "SUM( real_rpm ) as real_rpm",
        "SUM( real_pln ) as real_pln",
        "( ( real_rpm + real_pln )/ total * 100 ) as financial_progress",
        // "SUM( 100 ) as physical_total",
        " ( activity.physical_progress / SUM( 100 ) * 100 )   as physical_progress",
        "0 as ceiling_block",
        "0 as description",
      ]);
      
      $this->db->from( 
        '
              ( 
                SELECT 
                    activity.*,
                    ( activity.ceiling_rpm + activity.ceiling_pln ) as total,
                    SUM( CASE WHEN budget.status = 1 AND budget.rpm_pln = 0 THEN  budget.nominal ELSE 0 end  ) as real_rpm,
                    SUM( CASE WHEN budget.status = 1 AND budget.rpm_pln = 1 THEN  budget.nominal ELSE 0 end  ) as real_pln
                  From 
                    (
                    	SELECT
                            activity.*,
                        	  SUM( CASE WHEN physical.status = 1 THEN  physical.progress ELSE 0 end  ) as physical_progress
                         From 
                            activity
                        INNER JOIN
                            physical
                        on 
                            physical.activity_id = activity.id
                        GROUP BY activity.id 

                    )
                    activity
                  INNER JOIN
                      budget
                  on 
                      budget.activity_id = activity.id
                  
                  GROUP BY budget.activity_id 
              ) activity
        '
       );
      $this->db->join( "nomenclature","on nomenclature.id = activity.nomenclature_id", "inner" );

      if ( isset( $year ) )
          $this->db->where( $this->table.'.year', $year);
      if ( isset( $nomenclature_id ) )
          $this->db->where( 'nomenclature_id', $nomenclature_id);
      if ( isset( $pptk_id ) )
          $this->db->where( 'pptk_id', $pptk_id);
      
      return $this->db->get(  );
  }

}
?>
