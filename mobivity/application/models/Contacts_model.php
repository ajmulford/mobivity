<?php
class Contacts_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_contacts($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = "select contacts.contactID, contacts.fullName, contacts.phone, contacts.email, companies.companyName, country.nicename from contacts, companies, country
                        where contacts.active = 1
                        AND contacts.country = country.id
                        AND contacts.company = companies.companyNumber"; 
                        $result =   $this->db->query($query);           
                        return $result->result_array();
                }

                $query = "select contacts.contactID, contacts.fullName, contacts.phone, contacts.email, companies.companyName, country.nicename from contacts, companies, country
                where contacts.contactID = ".$slug." 
                AND contacts.active = 1
                AND contacts.country = country.id
                AND contacts.company = companies.companyNumber"; 
                $result =   $this->db->query($query);           
                return $result->row_array();
        }

        public function delete($id) 
        {
            $this->db->set('active', 0);
            $this->db->where('contactID', $id);
            $this->db->update('contacts');
            return $this->db->affected_rows() > 1 ? true:false;
        }

        public function get_companies()
        {
            $Companyquery = "select companyNumber, companyName from companies"; 
            $Companyresult =   $this->db->query($Companyquery);           
            $CompanyArray = array();
            foreach ($Companyresult->result_array() as $row) { 
                $CompanyArray[$row['companyNumber']]=$row['companyName'];
            }   
            return $CompanyArray;
        }
            
        public function get_countries()
        {
            $Countryquery = "select id, nicename from country"; 
            $Countryresult =   $this->db->query($Countryquery);           
            $CountryArray = array();
            foreach ($Countryresult->result_array() as $row) { 
                $CountryArray[$row['id']]=$row['nicename'];
            }   
            return $CountryArray;
        }

        public function get_by_id($id)
        {
            $this->db->from('contacts');
            $this->db->where('contactID',$id);
            $query = $this->db->get();

            return $query->row();
        }

        public function contacts_add($data)
        {
            $this->db->insert('contacts', $data);
            return $this->db->insert_id();
        }

        public function contacts_update($where, $data)
        {
            $this->db->update('contacts', $data, $where);
            return $this->db->affected_rows();
        }

        public function get_reports($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = "select COUNT(logID) as total, action FROM log GROUP BY action"; 
                        $result =   $this->db->query($query);           
                        return $result->result_array();
                }

                $query = $this->db->get_where('log', array('logID' => $slug));
                return $query->row_array();
        }

        public function get_dailyreports($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $dailyquery = "SELECT DATE(timestamp) as Date, COUNT(action) as totalCount FROM log GROUP BY Date ORDER BY Date desc limit 0,7"; 
                        $dailyresult =   $this->db->query($dailyquery);           
                        return $dailyresult->result_array();
                }

                $query = $this->db->get_where('log', array('logID' => $slug));
                return $query->row_array();
        }

        public function logEntry($slug = NULL, $ipAddress, $timestamp, $action)
        {
                $data['contacts_item'] = $this->Contacts_model->get_contacts($slug);

                if (!empty($data['contacts_item']))
                {
                    $this->db->set('ipaddress', $ipAddress);
                    $this->db->set('timestamp', $timestamp);
                    $this->db->set('contactID', $slug);
                    $this->db->set('action', $action);
                    $this->db->insert('log');
                }
        }
        

}
