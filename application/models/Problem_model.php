<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Problem_model extends MY_Model
{
  protected $table = "problem";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'problem_id' );
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
   * @param int|array|null $id = id_problem
   * @return static
   * @author madukubah
   */
  public function problem( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->problems(  );

      return $this;
  }


  /**
   * problem
   *
   *
   * @return static
   * @author madukubah
   */
  public function problems( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL,  $activity_id = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->select( $this->table.'.*' );
      $this->select(  'activity.title as activity_title'  );
      $this->select(  'report_date as _report_date ' );
      $this->select(  'problem_date as _problem_date ' );
      $this->select(  'settlement_date as _settlement_date ' );

      $this->select(  'DATE_FORMAT( report_date , "%m/%d/%Y" ) as report_date ' );
      $this->select(  'DATE_FORMAT( problem_date , "%m/%d/%Y" ) as problem_date ' );
      $this->select(  'DATE_FORMAT( settlement_date , "%m/%d/%Y" ) as settlement_date ' );
      $this->join(
        "activity",
        "activity.id = " . $this->table . ".activity_id",
        "inner"
      );
      $this->offset( $start );

      if ( isset( $year ) )
          $this->where( 'activity.year', $year);
      if ( isset( $nomenclature_id ) )
          $this->where( 'nomenclature_id', $nomenclature_id);
      if ( isset( $pptk_id ) )
          $this->where( 'pptk_id', $pptk_id);
      if ( isset( $activity_id ) )
          $this->db->where( 'activity.id', $activity_id);

      $this->order_by( $this->table.'.report_date', 'asc');
      return $this->fetch_data();
  }

}
?>
