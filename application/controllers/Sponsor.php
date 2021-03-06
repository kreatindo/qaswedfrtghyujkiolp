<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_sponsor');
	}

	public function index()
	{
		$data['sponsor'] = 'a';
		$data_content['content'] = $this->load->view('v_sponsor', $data, TRUE);
		$data_content['sidebar'] = $this->load->view('v_sidebar', $data, TRUE);
		$this->load->view('v_main', $data_content, FALSE);
	}	

	public function get_datatable()
	{
		$customActionName=$this->input->post('customActionName');
		if ($customActionName == "delete") {
			$this-> delete_checked();
		}

		$iTotalRecords   = $this->m_sponsor->count_all();
		$iDisplayLength  = intval($_REQUEST['length']);
		$iDisplayLength  = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart   = intval($_REQUEST['start']);
		$sEcho           = intval($_REQUEST['draw']);
		
		$records         = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = $end > $iTotalRecords ? $iTotalRecords : $end;

		$get = $this->m_sponsor->get_datatable($iDisplayStart, $iDisplayLength);
		
		$i=$iDisplayStart+1;

		if ($get) {
			foreach ($get as $d) {
			    $id = $d->ID_SPONSOR;
			    $lihat='<a class="btn btn-primary btn-sm" href="javascript:lihat('.$id.');">
					<i class="fa fa-search-plus"></i>
					Detail
					</a>';
				$edit='<a class="btn btn-info btn-sm" href="javascript:edit('.$id.');">
					<i class="fa fa-edit"></i>
					Edit
					</a>';
				$hapus='<a class="btn btn-danger btn-sm" href="javascript:hapus('.$id.');">
					<i class="fa fa-trash"></i>
					Hapus
					</a>';
				
				$records["data"][] = array(
					$i++,
					$d->NAMA,
					$d->ALAMAT,
					$lihat.$edit.$hapus
				);
			}
		}else{
			// $records["data"][] = array();
		}

		$records["draw"]            = $sEcho;
		$records["recordsTotal"]    = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		$this->output->set_content_type('application/json')->set_output(json_encode($records));
	}


	public function add()
	{
		$data['title'] = 'Tambah Sponsor';
		$data['akses_field'] = '';
		$this->load->view('v_sponsor_modal', $data);
	}

	public function edit($id, $readonly='', $title='Edit Sponsor')
	{
		$data['title']       = $title;
		$data['akses_field'] = $readonly;
		$data['sponsor']     = $this->m_sponsor->get_by($id);
		$this->load->view('v_sponsor_modal', $data);
	}

	public function lihat($id)
	{
		$this->edit($id,'readonly', 'Detail Sponsor');
	}

	public function save()
	{
		$res['sponsor'] = $this->m_sponsor->save();
		$this->output->set_content_type('application/json')->set_output(json_encode($res));
	}	

	public function delete($id)
	{
		$res['sponsor'] = $this->m_sponsor->delete($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($res));
	}


}

/* End of file sponsor.php */
/* Location: ./application/controllers/sponsor.php */