public function addRecordToTable()
{
    $this->form_validation->set_rules('name' , 'Name', 'required');

    if ($this->form_validation->run() == true) {
        $array = array(
            'name'      => $this->input->post('name')
        );

        $record_id = $this->some_model->addData('some_table', $array);
        $this->uploadFiles($record_id);
    }
}

public function uploadFiles($record_id)
{
    $config = array(
        'upload_path'   => FCPATH . "path\to\directory",
        'allowed_types' => 'jpg|png|jpeg',
        'overwrite'     => TRUE,                       
    );

    $this->load->library('upload', $config);

    $files = $_FILES['uploads'];

    foreach ($files['name'] as $key => $filename) {
        $_FILES['uploads[]']['name']     = $files['name'][$key];
        $_FILES['uploads[]']['type']     = $files['type'][$key];
        $_FILES['uploads[]']['tmp_name'] = $files['tmp_name'][$key];
        $_FILES['uploads[]']['error']    = $files['error'][$key];
        $_FILES['uploads[]']['size']     = $files['size'][$key];

        $config['file_name'] = $filename;

        $this->upload->initialize($config);

        if (isset($_FILES['uploads[]']['name']) && !empty($_FILES['uploads[]']['name'])) {
            if ( ! $this->upload->do_upload('uploads[]')) {
                $error = array('error' => $this->upload->display_errors());

            } else {
                $uploads[] = $this->upload->data();
                $array = array(
                    'record_id' => $record_id,
                    'filename'  => $_FILES['uploads[]']['name'],
                    'size'      => $_FILES['uploads[]']['size']
                );
                $this->some_model->addData('uploads', $array);
            }
        }
    }
    redirect(base_url() . 'someController/someFunction/' . $record_id);
}