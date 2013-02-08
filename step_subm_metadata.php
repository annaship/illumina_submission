<?php include("ill_subm_beginning.php"); ?>
<?php include('filled_variables.php'); ?>

      <h1>Illumina files processing</h1>
      <?php include_once("ill_subm_menu.php"); ?>

      <?php 
      /*
run
data_owner
run_key
lane
dataset
project
tubelabel
barcode
adaptor
dna_region
amp_operator
seq_operator
barcode_index
overlap
insert_size
read_length
primer_suite
first_name
last_name
email
institution
project_title
project_description
funding
env_sample_source
dataset_description 
       * */

      
      ?>
      
    <?php include("form_1_run_info.php"); ?>      
    <!-- TODO: mv onclick to unobtrusive js-->
    <br />
    <input type="button" value="Add new project" class="hide_project" />
    
    <table>
         <!-- mv to css 
                  <tr style="display:none;" class="hide">
          -->
         <tr style="display:none;" class="hide_project">
           <td colspan="3">
             <?php include("form_4_project.php"); ?>                 
        </td>
      </tr>
    </table>
    
    <br />
    <input type="button" value="Add new owner" class="hide_owner" />
    <table>
         <tr style="display:none;" class="hide_owner">
           <td colspan="3">
             <?php include("form_2_owner.php"); ?>                 
        </td>
      </tr>
    </table>        
    <br />
    
      <?php include("form_3_metadata_table.php"); ?>      
      
      
      <!-- end of content -->    
<?php include_once("ill_subm_end.php"); ?>     
