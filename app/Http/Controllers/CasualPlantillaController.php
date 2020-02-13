<?php

namespace App\Http\Controllers;
use App\Appointment;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Response;
/**
 * 
 */

class CasualPlantillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $lastRow = 0;
    private $currentMergedCells = "";

    public function index()
    {
        $matchThese = [
            'from_date'=>'2020-01-01',
            'to_date'=>'2020-06-30',
            'nature_of_appointment' => 'REAPPOINTMENT',
            'department_id'=>1
        ];
        $casuals = Employee::join('appointments', 'appointments.employee_id', '=', 'employees.id')
            ->where($matchThese)
            ->select('*')
            ->get();

        // $appointments = DB::table('appointments')->distinct()->get(['from_date','to_date','nature_of_appointment']);
        $appointments = Appointment::distinct()->get(['from_date','to_date','nature_of_appointment']);
        $departments = Department::orderBy('short_name', 'asc')->get();


        return view('casual.plantilla.index', [
            'appointments' => $appointments->toArray(),
            'departments' => $departments,
            'casuals' => $casuals
        ]);
    }

    // public function generateReport(Request $request){
    //     $from_date = $request->from_date;
    //     $to_date = $request->to_date;
    //     $nature_of_appointment = $request->nature_of_appointment;
    //     $filter = $request->filter;




    //     // return Response::json($from_date.$to_date.$nature_of_appointment.$filter);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //
    }
    public function generateReport(Request $request){

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $nature_of_appointment = $request->nature_of_appointment;
        $department_id = $request->filter;


        $matchThese = [
            'from_date'=>$from_date,
            'to_date'=>$to_date,
            'nature_of_appointment' => $nature_of_appointment,
        ];


        if($department_id == 'all'){
            $department = "LGU BAYAWAN CITY";
        } else {
            $where = array('id' => $department_id);
            $dept  = Department::where($where)->first();
            $department = $dept['name'];
            $matchThese['department_id'] = $department_id;
        }

        $casuals = Employee::join('appointments', 'appointments.employee_id', '=', 'employees.id')
            ->where($matchThese)
            ->select('*')
            ->orderBy('last_name','asc')
            ->get();

        // Create new Spreadsheet object
        
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('FranzDev')
            ->setLastModifiedBy('FranzDev')
            ->setTitle('Report Plantilla')
            ->setSubject('for Casual Employees')
            ->setDescription('Generated plantilla report for casual employees.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Report excel file');

    $spreadsheet->getActiveSheet()->getPageSetup()
    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    $spreadsheet->getActiveSheet()->getPageSetup()
    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
// style
$italic = [
    'italic'
];
    
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);
    

        // Add some data


// data
$count = count($casuals);
$pages = intval($count/15);
if ($count>($pages*15)) {
    $pages = $pages+1;
}
$totalNo = $pages*15;
$numbering = 1;
// row number to start
$startRow = 2;
$end = false;
for ($page=1; $page <= $pages ; $page++) {
// Head
$this->headSection($department,$spreadsheet,$startRow);

    for ($i=1; $i <= 15; $i++) {
        // (isset($casuals[$numbering-2])?$end = true:$end = false);
        $numbering++;
        // echo $numbering++.'. '.(isset($name[$numbering-2])?$name[$numbering-2]:($end?nothingFollows($end):'')).'<br>';  
        $row = $this->lastRow+1;
        $num = $numbering-1;
    

        if (!$end && !isset($casuals[$num-1]['last_name'])) {
            $end = true;
            $this->nothingFollows($spreadsheet,$row);
        } else {

        $col = 'A';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row,$num);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getLeft()->setBorderStyle('thick');

        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = "B";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':C'.$row);
        $spreadsheet->getActiveSheet()->getCell('B'.$row)->setValue((isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['last_name']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':C'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = "D";
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['first_name']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = "E";
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['ext_name']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = "F";
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['middle_name']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'G';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['position_title']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'H';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['sg']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'I';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?'Php. '.number_format((float)$casuals[$num-1]['daily_wage'], 2, '.', ''):''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'J';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?date_format(date_create($casuals[$num-1]['from_date']), 'm/d/Y'):''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'K';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?date_format(date_create($casuals[$num-1]['to_date']), 'm/d/Y'):''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'L';
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, (isset($casuals[$num-1]['last_name'])?$casuals[$num-1]['nature_of_appointment']:''));
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'M';
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, $casual['nature_of_appointment']);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $col = 'N';
        // $spreadsheet->setActiveSheetIndex(0)->setCellValue($col.$row, $casual['nature_of_appointment']);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(13);//data
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getRight()->setBorderStyle('thick');

        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(18);
        }

        $this->lastRow = $this->lastRow+1;
    }

    if ($totalNo == $count && $page == $pages) {
        // echo nothingFollows($end=false)."<br>";
            $row = $this->lastRow+1;
            $this->nothingFollows($spreadsheet,$row);
            $this->lastRow = $row;
    }

    $this->footSection($spreadsheet,$page,$pages);
    // number of rows before start row
    $startRow = $this->lastRow+4;
}
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(9);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(24);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(11.5);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(13);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(17.7);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);

        $spreadsheet->getActiveSheet()->setTitle((isset($dept['short_name'])?$dept['short_name']:'ALL_EMPLOYEES'));

        $spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.25);
        $spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.25);
        $spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.41);
        $spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.25);


        $spreadsheet->setActiveSheetIndex(0);
        // $spreadsheet->getActiveSheet()->getPageSetup()->setPrintArea('A1:N41');

        $b =-1;
        $printArea = '';
        for ($i=0; $i < $pages ; $i++) { 
            $a = $b+2;
            $b = $a+39;
            $printArea .= 'A'.$a.':N'.$b;
            if ($i != ($pages-1)) {
                $printArea .= ',';
            }
        }

        $spreadsheet->getActiveSheet()->getPageSetup()->setPrintArea($printArea);
        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);

        $this->lastRow = 0;
        $this->createRaiWorksheet($spreadsheet);


        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // file title
        header('Content-Disposition: attachment;filename="CASUAL PLANTILLA - '.(isset($dept['short_name'])?$dept['short_name']:'ALL EMPLOYEES').'_'.$from_date.'-'.$to_date.'_'.$nature_of_appointment.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        exit;
        
    }

    private function headSection($department,$spreadsheet,$startRow){

$spreadsheet->getActiveSheet()->mergeCells('M'.$startRow.':N'.($startRow+1));
        $spreadsheet->getActiveSheet()->mergeCells('M'.($startRow+2).':N'.($startRow+2));
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$startRow, 'CS Form No. 34-D')
            ->setCellValue('A'.($startRow+1), 'Revised 2018')
            ->setCellValue('M'.($startRow+2), '(Stamp of Date of Receipt)')
            ;
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);

$spreadsheet->getActiveSheet()->getCell('M'.$startRow)->setValue("For Accredited/Deregulated\nLocal Government Units");
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(30);

$spreadsheet->getActiveSheet()->getStyle('M'.$startRow)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('M'.$startRow)->getAlignment()->setHorizontal('center');
$spreadsheet->getActiveSheet()->getStyle('M'.$startRow)->getFont()->setSize(12);

$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => 'thin',
            // 'color' => ['argb' => 'black'],
        ],
    ],
];

$spreadsheet->getActiveSheet()->getStyle('M'.$startRow.':N'.($startRow+1))->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->getStyle('M'.($startRow+2))->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('M'.($startRow+2))->getAlignment()->setHorizontal('center');

         // set style
$spreadsheet->getActiveSheet()->getStyle('A'.($startRow+1))->getFont()->setItalic(true)->setSize(9);

// Header Title
$row = $startRow+5;
$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("Republic of the Philippines");
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
$row = $startRow+6;
$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("Province of Negros Oriental");
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
// $row = 9;
$row = $startRow+7;
$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("CITY OF BAYAWAN");
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
// $row = 11;
$row = $startRow+9;
$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("PLANTILLA OF CASUAL APPOINTMENTS");
$spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(14);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal('center');
// $row = 13;
$row = $startRow+11;
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("Department/Office:");
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);

// $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12.5);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12.5);

$spreadsheet->getActiveSheet()->mergeCells('C'.$row.':G'.$row);
$spreadsheet->getActiveSheet()->getStyle('C'.$row.':G'.$row)->getBorders()->getBottom()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getCell('C'.$row)->setValue($department);
$spreadsheet->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal('center');
// $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

$spreadsheet->getActiveSheet()->getCell('L'.$row)->setValue("Source of Funds:");
$spreadsheet->getActiveSheet()->getStyle('L'.$row)->getAlignment()->setHorizontal('right')->setVertical('center');
$spreadsheet->getActiveSheet()->mergeCells('M'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('M'.$row)->setValue("PS");
$spreadsheet->getActiveSheet()->getStyle('M'.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
$spreadsheet->getActiveSheet()->getStyle('M'.$row.':N'.$row)->getBorders()->getBottom()->setBorderStyle('thin');
        
// $row = 14;
$row = $startRow+12;

// $instructions = "INSTRUCTIONS:\n(1)   Only a maximum of fifteen (15) appointees must be listed on each page of the Plantilla of Casual Appointments.\n(2)   Indicate ‘NOTHING FOLLOWS’ on the row following the name of the last appointee on the last page of the Plantilla.\n(3)   Provide proper pagination (Page n of n page/s).";

$richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
// $richText->createText('This invoice is ');
$payable = $richText->createTextRun('INSTRUCTIONS:');
$payable->getFont()->setBold(true);
$richText->createText('
(1)   Only a maximum of fifteen (15) appointees must be listed on each page of the Plantilla of Casual Appointments.
(2)   Indicate ‘NOTHING FOLLOWS’ on the row following the name of the last appointee on the last page of the Plantilla.
(3)   Provide proper pagination (Page n of n page/s).');
// $spreadsheet->getActiveSheet()->getCell('A18')->setValue($richText);

$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue($richText);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(14);
$spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(78);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical('center');

// $row = 15;
$row = $startRow+13;
$spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(30);
$spreadsheet->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
$spreadsheet->getActiveSheet()->getCell('A'.$row)->setValue("NAME OF APPOINTEE/S");
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->getBorders()->getOutline()->setBorderStyle('thin');

// $row = 16;
$row = $startRow+14;
$spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(40);
$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->mergeCells('B'.$row.':C'.$row);
$spreadsheet->getActiveSheet()->getCell('B'.$row)->setValue("Last Name");
$spreadsheet->getActiveSheet()->getStyle('B'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle('B'.$row.':C'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getCell('D'.$row)->setValue("First Name");
$spreadsheet->getActiveSheet()->getStyle('D'.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle('D'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(17);
$col = "E";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Name\nExtension\n(Jr/III)");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(10);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(66);

$col = "F";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Middle Name");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(17);
// $row = 15;
$row = $startRow+13;
$col = "G";
$spreadsheet->getActiveSheet()->mergeCells($col.$row.':'.$col.($row+1));
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("POSITION TITLE\n(Do not abbreviate)");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row.':'.$col.($row+1))->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(17);
$col = "H";
$spreadsheet->getActiveSheet()->mergeCells($col.$row.':'.$col.($row+1));
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("EQUIVALENT\nSALARY/\nJOB/\nPAY GRADE");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(10);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row.':'.$col.($row+1))->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(11);
$col = "I";
$spreadsheet->getActiveSheet()->mergeCells($col.$row.':'.$col.($row+1));
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("DAILY\nWAGE");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row.':'.$col.($row+1))->getBorders()->getOutline()->setBorderStyle('thin');
$col = "J";
$spreadsheet->getActiveSheet()->mergeCells($col.$row.':K'.$row);
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("PERIOD OF EMPLOYMENT");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
$spreadsheet->getActiveSheet()->getStyle($col.$row.':K'.$row)->getBorders()->getOutline()->setBorderStyle('thin');

// $row = 16;
$row = $startRow+14;
$col = "J";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("From\n(mm/dd/yyyy)");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(15);
$col = "K";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("To\n(mm/dd/yyyy)");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(15);

// $row = 15;
$row = $startRow+13;
$col = "L";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("NATURE OF APPOINTMENT");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(14);
// $row = 16;
$row = $startRow+14;
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("(Original/\nReappointment/\nReemployment)");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(14);
// $row = 15;
$row = $startRow+13;
$col = "M";
$spreadsheet->getActiveSheet()->mergeCells($col.$row.':N'.$row);
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("ACKNOWLEDGEMENT OF APPOINTEE/S");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row.':N'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
// $row = 16;
$row = $startRow+14;
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Signature");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(22);
$col = "N";
$spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Date Received");
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getOutline()->setBorderStyle('thin');
$spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(22);

$spreadsheet->getActiveSheet()->getStyle('A'.($startRow+13).':N'.($startRow+14))->getBorders()->getOutline()->setBorderStyle('thick');

$this->lastRow = $startRow+14;

    }
    private function footSection($spreadsheet,$page,$pages){
        $col = "A";
        $row = $this->lastRow+1;
        $subquote = 'The abovenamed personnel are hereby hired/appointed as casuals at the rate of compensation stated opposite their names for the period indicated. It is understood that such employment will cease  automatically at the end of the period stated unless renewed. Any or all of them may be laid-off any time before the expiration of the employment period when their services are no longer needed or funds are no longer available or the project has already been completed/finished or their performance are below par.';
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':N'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue($subquote);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':N'.$row)->getBorders()->getOutline()->setBorderStyle('thick');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(50);

        $row = $row+2;
        $col = "A";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':D'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("CERTIFICATION:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('top');
        $col = "F";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':G'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("CERTIFICATION:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('top');

        $col = "I";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':K'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("CERTIFICATION AND SIGNATURE OF\nAPPOINTING OFFICER / AUTHORITY:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);

        $col = "M";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':N'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("ACCREDITED PURSUANT TO:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('top');

        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(30);

        $row = $row+1;
        $col = "A";
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $richText->createText('This is to certify that all requirement and supporting papers pursuant to ');
        $payable = $richText->createTextRun('CSC MC No. 14 s. 2018, ');
        $payable->getFont()->setBold(true);
        $richText->createText('have been complied with, reviewed and found in order.');
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':D'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);

        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(81);

        $col = "F";
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $richText->createText('This is to certify that funds are available pursuant to Appropriation Ordinance No.');
        $payable = $richText->createTextRun(' 62 ');
        $payable->getFont()->setUnderline(true);
        $richText->createText(' series of ');
        $payable = $richText->createTextRun(' 2019 ');
        $payable->getFont()->setUnderline(true);
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':G'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        
        
        $col = "I";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':K'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("This is to certify that all pertinent provisions of Sec. 325 of RA 7160 (Local Government Code of 1991) have been complied with in the issuance of appointments of the above-mentioned persons.");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        

        $col = "M";
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("CSC Resolution No:\nDate:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('right')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);

        $col = "N";
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('1201478');
        $payable->getFont()->setUnderline(true);
        $richText->createText("\n");
        $payable = $richText->createTextRun('September 26, 2012');
        $payable->getFont()->setUnderline(true);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);



        $row = $row+1;
        $col = "A";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':D'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("VERONICA GRACE P. MIRAFLOR");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':D'.$row)->getBorders()->getBottom()->setBorderStyle('thin');    

        $col = "F";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':G'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("CORAZON P. LIRAZAN ");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':G'.$row)->getBorders()->getBottom()->setBorderStyle('thin');    

        $col = "I";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':K'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("PRYDE HENRY A. TEVES");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':K'.$row)->getBorders()->getBottom()->setBorderStyle('thin');

        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(30);

        $row = $row+2;
        $col = "B";
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Date:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('right')->setVertical('bottom');

        $col = "C";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':D'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("January 1, 2020");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':D'.$row)->getBorders()->getBottom()->setBorderStyle('thin');    

        $col = "F";
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Date:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('right')->setVertical('bottom');

        $col = "G";
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("January 1, 2020");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getBorders()->getBottom()->setBorderStyle('thin');

        $col = "I";
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("Date:");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('right')->setVertical('bottom');

        $col = "J";
        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':K'.$row);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue("January 1, 2020");
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('bottom');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':K'.$row)->getBorders()->getBottom()->setBorderStyle('thin');


        $row = $row+1;
        $col = "N";
        $richText = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        $payable = $richText->createTextRun('Page ');
        $payable->getFont()->setBold(true);
        $payable = $richText->createTextRun($page);
        $payable->getFont()->setBold(true);
        $payable = $richText->createTextRun(' of ');
        $payable->getFont()->setBold(true);
        $payable = $richText->createTextRun($pages);
        $payable->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue($richText);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('left')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(12);
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('right')->setVertical('bottom');


        $this->lastRow = $row;
    }


    private function nothingFollows($spreadsheet,$row){
        $col = "A";

        $spreadsheet->getActiveSheet()->mergeCells($col.$row.':N'.$row);

        $spreadsheet->getActiveSheet()->getCell($col.$row)->setValue('***NOTHING FOLLOWS***');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':N'.$row)->getBorders()->getOutline()->setBorderStyle('thin');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':N'.$row)->getBorders()->getLeft()->setBorderStyle('thick');
        $spreadsheet->getActiveSheet()->getStyle($col.$row.':N'.$row)->getBorders()->getRight()->setBorderStyle('thick');
        
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
        $spreadsheet->getActiveSheet()->getStyle($col.$row)->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight(15);
    }

    public function mergeCells($pRange)
    {
        // Uppercase coordinate
        $pRange = strtoupper($pRange);
        $this->currentMergedCells = $pRange;
        if (strpos($pRange, ':') !== false) {
            $this->mergeCells[$pRange] = $pRange;

            // make sure cells are created

            // get the cells in the range
            $aReferences = Coordinate::extractAllCellReferencesInRange($pRange);

            // create upper left cell if it does not already exist
            $upperLeft = $aReferences[0];
            if (!$this->cellExists($upperLeft)) {
                $this->getCell($upperLeft)->setValueExplicit(null, DataType::TYPE_NULL);
            }

            // Blank out the rest of the cells in the range (if they exist)
            $count = count($aReferences);
            for ($i = 1; $i < $count; ++$i) {
                if ($this->cellExists($aReferences[$i])) {
                    $this->getCell($aReferences[$i])->setValueExplicit(null, DataType::TYPE_NULL);
                }
            }
        } else {
            throw new Exception('Merge must be set on a range of cells.');
        }

        return $this;
    }

    // private $startingRow = 0;
    private function createRaiWorksheet($spreadsheet)
    {
        $worksheet1 = $spreadsheet->createSheet();
        $worksheet1->setTitle('RAI');
        

        // create head of RAI
        $row = $this->lastRow;
        $col = 'A';
        $colend = 'S';
        $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->getActiveSheet()
            ->setCellValue($col.$this->nextRow(), 'CS Form No. 2')
            ->setCellValue($col.$this->nextRow(), 'Revised 2017')->getStyle($col.$this->currentRow())->getFont()->setBold(true)->setItalic(true)->setSize(9);
        $spreadsheet->getActiveSheet()
            ->mergeCells($col.$this->nextRow(2).":".$colend.$this->currentRow())->getCell($col.$this->currentRow())->setValue($this->mergeCells('A9:B9'));
                                                                             
            // For the month of JANUARY 2020                                                                       
    }


    private function nextRow($rowApart=1){
        $this->lastRow = $this->lastRow+$rowApart;
        return ($this->lastRow);
    }

    private function currentRow(){
        return $this->lastRow;
    }

    // private function  currentCells($cola,$rowa,$colb,$rowb){
    //     $mergeCells = 
    //     return $mergeCells;
    // }


}
