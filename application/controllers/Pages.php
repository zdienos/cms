<?php

class Pages extends MY_Controller
{
	public function view($page = 'login')
	{
        if (!file_exists(APPPATH.'views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        if($page == 'section' || $page == 'subject' || $page == 'student' || $page == 'marksheet' || $page == 'accounting') {
            $this->load->model('Model_classes');
            $data['classData'] = $this->Model_classes->fetchClassData();

            $this->load->model('Model_teacher');
            $data['teacherData'] = $this->Model_teacher->fetchTeacherData();


            $this->load->model('Model_accounting');
            $data['totalIncome'] = $this->Model_accounting->totalIncome();
            $data['totalExpenses'] = $this->Model_accounting->totalExpenses();
            $data['totalBudget'] = $this->Model_accounting->totalBudget();
        }

        if($page == 'setting') {
            $this->load->model('Model_users');
            $this->load->library('session');
            $userId = $this->session->userdata('id');
            $data['userData'] = $this->Model_users->fetchUserData($userId);
        }

        if($page == 'dashboardss') {
            $this->load->model('Model_student');
            $this->load->model('Model_teacher');
            $this->load->model('Model_classes');
            $this->load->model('Model_marksheet');
            $this->load->model('Model_accounting');

            $data['countTotalStudent'] = $this->Model_student->countTotalStudent();
            $data['countTotalTeacher'] = $this->Model_teacher->countTotalTeacher();
            $data['countTotalClasses'] = $this->Model_classes->countTotalClass();
            $data['countTotalMarksheet'] = $this->Model_marksheet->countTotalMarksheet();

            $data['totalIncome'] = $this->Model_accounting->totalIncome();
            $data['totalExpenses'] = $this->Model_accounting->totalExpenses();
            $data['totalBudget'] = $this->Model_accounting->totalBudget();
        }

        if($page == 'login') {
            $this->belumLogin();
            $this->load->view($page, $data);
        }
        else{
            $this->sudahLogin();

            $this->load->view('templates/header', $data);
            $this->load->view($page, $data);
            $this->load->view('templates/footer', $data);
        }
	}

}
