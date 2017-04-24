<?php
class Contacts extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Contacts_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['contacts'] = $this->Contacts_model->get_contacts();
                $data['title'] = 'Contacts archive';
                $data['companies'] = $this->Contacts_model->get_companies();
                $data['countries'] = $this->Contacts_model->get_countries();

                $this->load->view('templates/header', $data);
                $this->load->view('contacts/index');
                $this->load->view('templates/footer');

        }

		public function ajax_edit($id)
		{
			$data = $this->Contacts_model->get_by_id($id);

			echo json_encode($data);
		}

        public function contacts_add()
        {
            $data = array(
                    'company' => $this->input->post('company'),
                    'fullName' => $this->input->post('fullName'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'country' => $this->input->post('country'),
                );
            $this->Contacts_model->logEntry($this->input->post('contactID'), $this->input->post('clientIP'), date("Y-m-d H:i:s",time()), 'Add');

            $insert = $this->Contacts_model->contacts_add($data);

            echo json_encode(array("status" => TRUE));
        }

		public function contacts_update()
        {
            $data = array(
                    'company' => $this->input->post('company'),
                    'fullName' => $this->input->post('fullName'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'country' => $this->input->post('country'),
                );
            $this->Contacts_model->contacts_update(array('contactID' => $this->input->post('contactID')), $data);
            $this->Contacts_model->logEntry($this->input->post('contactID'), $this->input->post('clientIP'), date("Y-m-d H:i:s",time()), 'Update');
            echo json_encode(array("status" => TRUE));
        }

        public function edit($id)
        {
            $this->load->library('form_validation');

            if($this->form_validation->is_natural_no_zero($id)===FALSE)
            {
                redirect('home');
            }

            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Edit contact';

            $data['contacts_item'] = $this->Contacts_model->get_contacts($id);
            $data['companies'] = $this->Contacts_model->get_companies();
            $data['countries'] = $this->Contacts_model->get_countries();

            $this->form_validation->set_rules('fullName', 'Full Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('contacts/edit');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->Contacts_model->set_contacts();
                $this->load->view('contacts/success');
            }
        }

        public function delete($id) 
        {
            if($id)
            {
                $this->Contacts_model->logEntry($id, $_SERVER['REMOTE_ADDR'], date("Y-m-d H:i:s",time()), 'Delete');

                $this->Contacts_model->delete($id);

                echo json_encode(array("status" => TRUE));
            }
            return false;
        }

        public function reports()
        {
                $data['log'] = $this->Contacts_model->get_reports();
                $data['dailylog'] = $this->Contacts_model->get_dailyreports();
                $data['title'] = 'Reports';
                
                $data['companies'] = $this->Contacts_model->get_companies();
                $data['countries'] = $this->Contacts_model->get_countries();

                $this->load->view('templates/header', $data);
                $this->load->view('contacts/reports', $data);
                $this->load->view('templates/footer');

        }

}