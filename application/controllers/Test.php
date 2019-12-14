$table = NULL;
		$table = $this->services->get_month_table_config( $this->current_page );
		$budget_realization = $this->budget_model->budget_by_activity_id( $activity_id,  1, 0 )->row();
		$budget_realization->title = 'RPM ( Ribu )';
		$budget_realization_pln = $this->budget_model->budget_by_activity_id( $activity_id,  1 )->row();
		$budget_realization_pln->title = 'PLN ( Ribu )';
		$physical_realization = $this->physical_model->physical_by_activity_id( $activity_id,  1 )->row();
		$physical_realization = $this->services->get_physical_prefix_sum( $physical_realization );
		$physical_realization->title = 'Fisik';
		
		$table[ "rows" ] = [ $budget_realization, $budget_realization_pln, $physical_realization ] ; //$this->services->get_budget_physical_row( $budget_plan_rpm, $budget_plan_pln, $physica_plan );
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "realization_table" ] = $table ;