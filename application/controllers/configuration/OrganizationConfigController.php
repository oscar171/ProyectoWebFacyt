<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include (APPPATH. '/libraries/ChromePhp.php');
include (APPPATH. '/libraries/Doctrine/Common/Collections/Collection.php');

class OrganizationConfigController extends CI_Controller {
    
    public function index() {
        $this->load->view('configuration/organizationConfig');
    }
    
    public function getAllDepartments() {
         try {
             
            $em = $this->doctrine->em;
            $departments = $em->getRepository('\Entity\Department')->findAll();
            
            foreach ($departments as $key=>$department) {
                $result['data'][$key]['id'] = $department->getId();
                $result['data'][$key]['name'] = $department->getName();
                $result['data'][$key]['description'] = $department->getDescription();
                //$result['data'][$key]['positions'] = $department->getPositions();
                $positions = $department->getPositions();
                foreach ($positions as $pkey=>$position) {
                    $result['data'][$key]['positions'][$pkey]['id'] = $position->getId();
                    $result['data'][$key]['positions'][$pkey]['name'] = $position->getName();
                    $result['data'][$key]['positions'][$pkey]['description'] = $position->getDescription();
                }
            }
            
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
    }
    
    public function saveDepartment() {
        
        try {
            
            $em = $this->doctrine->em;
            if(isset($_GET['id']) ) {
                $department = $em->find('\Entity\Department', $_GET['id']);   
                $department->setName( $_GET['name']);
                $department->setDescription($_GET['description']);

                $em->merge($department);
                $em->persist($department);
                $em->flush();
            } else {
                $department = new \Entity\Department();
                $department->setName( $_GET['name']);
                $department->setDescription($_GET['description']);
                $em->persist($department);
                $em->flush();
            }
            $result['message'] = "success";
        } catch(Exception $e) {
             $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
    }
    
    public function getAllPositions() {
        try {
            $em = $this->doctrine->em;
            $department = $em->find('\Entity\Department', $_GET['department']);
            $positions = $department->getPositions();
            foreach ($positions as $key=>$position) {
                $result['data'][$key]['id'] = $position->getId();
                $result['data'][$key]['name'] = $position->getName();
                $result['data'][$key]['description'] = $position->getDescription();
            }
            
            $result['message'] = "success";
       } catch(Exception $e) {
           \ChromePhp::log($e);
           $result['message'] = "Error";
       }

        echo json_encode($result);
    }
    
    public function savePosition() {
        try {
            $em = $this->doctrine->em;
            if(isset($_GET['id']) ) {
                $position = $em->find('\Entity\Position', $_GET['id']);   
                $position->setName( $_GET['name']);
                $position->setDescription($_GET['description']);

                $em->merge($position);
                $em->persist($position);
                $em->flush();
            } else {
                $position = new \Entity\Position();
                $position->setName( $_GET['name']);
                $position->setDescription($_GET['description']);
                $department = $em->find('\Entity\Department', $_GET['department']);
                $position->setDepartment($department);
                $department->addPosition($position);
                $em->persist($position);
                $em->merge($department);
                $em->persist($department);
                $em->flush();
            }
            $result['message'] = "success";
        } catch(Exception $e) {
             $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);       
    }
    
    function deletePosition() {
        try {
            $em = $this->doctrine->em;
            // Get the specified position.
            $position = $em->find('\Entity\Position', $_GET['id']);
            // Get it's department.
            $department = $position->getDepartment();
            // Remove this position from the department entity.
            $department->removePosition($position);
            // Delete de position.
            $em->remove($position);
            // Persist the changes in database.
            $em->flush();
            $result['message'] = "success";
        } catch (Exception $e) {
            $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);       
    }
    
    function deleteDepartment() {
        try {
            $em = $this->doctrine->em;
            $department = $em->find('\Entity\Department', $_GET['id']);
            $em->remove($department);
            $em->flush();
            $result['message'] = "success";
        } catch (Exception $e) {
            $result['message'] = "error";
            \ChromePhp::log($e);
        }
        echo json_encode($result);
    }
}