<?php

use Endroid\SimpleExcel\SimpleExcel;

/**
 * Description of postulantesController.
 *
 * @author jperez
 */
class postulantesController extends Controller
{
    private $excel;
    private $headers;

    public function __construct()
    {
        parent::__construct();
        $this->headers = array();
    }

    public function index()
    {
        echo 'hola mundo';
    }

    public function generateExcel($job = '')
    {
        $this->excel = new SimpleExcel();
        $objPHPExcel = new PHPExcel();

        $filename = 'postulantes.xlsx';

        $title = 'Relación de Postulantes';

        if (!empty($job)) {
            $infoJob = get_post($job);
            $filename = 'postulantes-'.$infoJob->post_name.'.xlsx';
            $title .= ' a '.$infoJob->post_title;
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Postulantes');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $title);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);

        $this->generateHeaderExcel($objPHPExcel);
        $this->generateCellsExcel($objPHPExcel, $job);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type XLSX
//        header('Content-Type: application/vnd.ms-excel'); //mime type XLS
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

//        $this->excel->loadFromArray(array('Postulantes' => $data));        
//        $this->excel->saveToOutput($filename, array('Postulantes'));
    }

    private function generateHeaderExcel(PHPExcel $excel)
    {
        $headers = $this->setHeaders();

        if (count($headers)) {
            foreach ($headers as $key => $value) {
                $excel->getActiveSheet()->setCellValue($key, $value);
                $excel->getActiveSheet()->getStyle($key)->getFont()->setSize(11);
                $excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
                $excel->getActiveSheet()->getStyle($key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }
        }
    }

    private function setHeaders()
    {
        $this->headers = array(
            'A3' => 'Nombre',
            'B3' => 'Correo electrónico',
            'C3' => 'Teléfono / Celular',
            'D3' => 'Convocatoria',
            'E3' => 'CV',
            'F3' => 'Fecha postulación',
        );

        return $this->headers;
    }

    private function generateCellsExcel(PHPExcel $excel, $job = '')
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'postulantes',
        );

        if (!empty($job)) {
            $value = array();
            $serValue = '';
            $newValue = '';

            $value[$job] = 'on';
            $serValue = serialize($value);
            $newValue = substr($serValue, 5);
            $newValue = substr($newValue, 0, -1);

            $args['meta_query'] = array(
                array(
                    'key' => 'mb_jobs',
                    'value' => $newValue,
                    'compare' => 'LIKE',
                ),
            );
        }

        $i = 4;
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();

                $id = get_the_ID();
                $values = get_post_custom($id);

                $name = (isset($values['mb_name'])) ? esc_attr($values['mb_name'][0]) : '';
                $email = (isset($values['mb_email'])) ? esc_attr($values['mb_email'][0]) : '';
                $phone = (isset($values['mb_tel'])) ? esc_attr($values['mb_tel'][0]) : '';
                $jobs = (isset($values['mb_jobs']) && !is_null($values['mb_jobs'])) ? $values['mb_jobs'][0] : 'Convocatoria General';
                $cv = isset($values['mb_cv']) ? home_url(esc_attr($values['mb_cv'][0])) : '';
                $datePostulation = get_the_time('d-m-Y');

                $infoJobs = '';
                if ($jobs !== 'Convocatoria General') {
                    $jobs = unserialize($jobs);

                    foreach ($jobs as $key => $value) {
                        $job = get_post($key);
                        $infoJobs .= $job->post_title.' | ';
                    }
                } else {
                    $infoJobs = 'Convocatoria General';
                }

                $excel->getActiveSheet()->setCellValue('A'.$i, $name);
                $excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('B'.$i, $email);
                $excel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('C'.$i, $phone);
                $excel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('D'.$i, $infoJobs);
                $excel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('E'.$i, $cv);
                $excel->getActiveSheet()->getCell('E'.$i)->getHyperlink()->setUrl($cv);
                $excel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('F'.$i, $datePostulation);
                $excel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(10);
                $excel->getActiveSheet()->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                ++$i;

//                $data[] = array(
//                    'Nombre' => $name,
//                    'Email' => $email,
//                    'Teléfono / Celular' => $phone,
//                    'Convocatoria' => $infoJobs,
//                    'CV' => $cv
//                );
            }
        }
        wp_reset_postdata();
    }
}
