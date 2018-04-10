<?php 
	class CrystalReport{
		public function generate($path_rpt,$reportName,$vals = array()){
			try {
				set_time_limit(300);
				$output_pdf = getcwd()."\\temp.pdf"; // RPT export to pdf file 
				//-Create new COM object-depends on your Crystal Report version 
				// $ObjectFactory= new COM("CrystalReports10.ObjectFactory.1") or die ("Error on load"); // call COM port
				// $crapp = $ObjectFactory->CreateObject("CrystalDesignRunTime.Application.10");
				$crapp = new COM("CrystalRunTime.Application");
				$creport = $crapp->OpenReport(getcwd()."\\".$path_rpt, 1); // call rpt report 

				// to refresh data before 

				//- Set database logon info - must have 
				$creport->Database->LogOnServer("pdsodbc.dll", "redtop_hotel", "redtop_hotel", "root", ""); 

				//- field prompt or else report will hang - to get through 
				$creport->EnableParameterPrompting = 0; 

				//- DiscardSavedData - to refresh then read records 
				$creport->DiscardSavedData; 
				$creport->ReadRecords(); 


				//------ Pass formula fields --------
				for($i=1;$i<=count($vals);$i++){
					$field=$creport->ParameterFields($i);
					$res=@$field->SetCurrentValue($vals[$i]);
					if($res==0){
						//success setting parameter value
					}else{
						return "Failed to create report.  Failed to set parameter $i with value ".$vals[$i];
					}
				}


				//export to PDF process 
				$creport->ExportOptions->DiskFileName= $output_pdf; //export to pdf 
				$creport->ExportOptions->PDFExportAllPages=true; 
				$creport->ExportOptions->DestinationType=1; // export to file 
				$creport->ExportOptions->FormatType=31; // PDF type
				$creport->Export(false); 

				//------ Release the variables ------ 
				$creport = null; 
				$crapp = null; 
				$ObjectFactory = null; 


				if(file_exists($output_pdf)){
					$pdf=file_get_contents($output_pdf);

					header("Cache-Control: public");
					header("Content-Description: File Transfer");
					header("Content-Disposition: attachment; filename=$reportName.pdf");
					header("Content-Type: application/pdf");
					header("Content-Transfer-Encoding: binary");
					// UPDATE: Add the below line to show file size during download.
					header('Content-Length: ' . filesize($output_pdf));

					echo $pdf;
					exit();
				}else return "Failed to export";
			}catch(Exception $ex){
				echo $ex;
			}
		}
	}

?>