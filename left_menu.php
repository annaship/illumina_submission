<div id='left_menu'>
<ul class='left_menu_ul'>
<li class='menu_title'>VAMPS Project</li>

   <li class='menu_link'><a href="/index.php" class="mainlevel">VAMPS Home</a></li>
   <li class='menu_link'><a href="/overview.php" class="mainlevel">VAMPS Overview</a></li>
   <li class='menu_link'><a href="http://vampsarchive.mbl.edu/" class="mainlevel">VAMPS Archive</a></li>
   <li class='menu_link'><a href="http://jbpc.mbl.edu" class="mainlevel">JBPC Home</a></li>
   

<li class='menu_title'>Visualization and Analysis</li>
    <li class='menu_link'><a href="/vamps/combined/combined.php" class="mainlevel">Community Visualization</a></li>
    <li class='menu_link'><a href="/vamps/otus/index.php" class="mainlevel">Clusters (OTUs)</a></li>
    <li class='menu_link'><a href="/vamps/search/search.php" class="mainlevel">Search</a></li> 
    <li class='menu_link'><a href="/project_pages/ppindex_all.php" class="mainlevel">View Projects</a></li>
    <li class='menu_link'><a href="/utils/list_data.php" class="mainlevel">View Datasets</a></li>
    <li class='menu_link'><a href="/metadata/list_metadata.php" class="mainlevel">View Metadata</a></li>
    <li class='menu_link'><a href="/qiime/qiime.php" class="mainlevel">QIIME</a></li>
    
<li class='menu_title'>Manage Your Data</li>
   <li class='menu_link'><a href="/vamps/stand_alone_combinations/" class="mainlevel">Customize Datasets</a></li>
 <li class='menu_link'><a href="/utils/admin_data.php" class="mainlevel">Administer Datasets</a></li>
 

<li class='menu_title'>Import Data</li>
   <li class='menu_link'><a href="/uploads/upload_data.php" class="mainlevel">Upload Data to VAMPS</a></li>


<li class='menu_title'>Export Data</li>   
   <li class='menu_link'><a href="/exporter/export_taxcounts.php" class="mainlevel">Taxonomic Counts</a></li>
   <li class='menu_link'><a href="/exporter/export.php" class="mainlevel">Trimmed Fasta Sequences</a></li>
 <!--  <li class='menu_link'><a href="/uploads/upload_data2.php" class="mainlevel">Upload Data to VAMPS</a></li>
 
-->
   <li class='menu_link'><a href="/diversity/diversity.php" class="mainlevel">Clusters and Diversity</a></li>


<li class='menu_title'>Portals</li>
<li class='menu_link'>
<form id='portal_form' name='portal_form' enctype='text/html'>
   <select name="select_portal" onchange='javascript:choose_portal(this.value)'>
   <option value="icomm" selected>Choose Portal ...</option>
   <option value="dco">Deep Carbon Obs.</option>
   <option value="hmp">Human Microbiome</option>
   <option value="icomm" >ICoMM (public)</option>   
   <option value="mirada">MIRADA</option>
   <option value="mobedac">MoBeDAC</option>
   <option value="rare">The Rare Biosphere</option>
   </select>
</form>
</li>

   

<li class='menu_title'>User Accounts</li>
   <li class='menu_link'><a href="/utils/info.php" class="mainlevel">Account Information</a></li>
   <li class='menu_link'><a href="/utils/submissions/project_submit.php" class="mainlevel">Project Submission</a></li>  
<li class='menu_link'><a href='/utils/submissions/admin_submission.php' class='mainlevel'>Project Submission -Admin</a></li>   
<li class='menu_title'>Resources</li>
   <li class='menu_link'><a href="/resources/databases.php" class="mainlevel">Reference Data/Files</a></li>
   <li class='menu_link'><a href="/resources/prim.php" class="mainlevel">Primers</a></li>
   <li class='menu_link'><a href="/resources/pubs.php" class="mainlevel">Publications</a></li>
   <li class='menu_link'><a href="/resources/software.php" class="mainlevel">Software/Links</a></li>

<li class='menu_title'>Helpful Information</li>
   <li class='menu_link'><a href="/resources/faq.php" class="mainlevel">F.A.Q.</a></li>
   <li class='menu_link'><a href="/resources/tutorial.php" class="mainlevel">Tutorial</a></li>
   <li class='menu_link'><a  href='/wiki/' class='mainlevel'>VAMPS Wiki</a></li>
   <li class='menu_link'><a href="/utils/contact.php" class="mainlevel">Contact Us</a></li>
   <li class='menu_link'><a href="/includes/updates.php" class="mainlevel">Recent Updates</a></li>   
   

</ul>
<script>
function choose_portal(portal)
{
   //alert('found choose portal')
   if(portal=='icomm'){
      window.open('/portals/icomm/icomm.php',"_self");
   }else if(portal=='dco'){
      window.open('/portals/deep_carbon/dco.php',"_self");
   }else if(portal=='mirada'){
      window.open('/portals/mirada/mirada.php',"_self");   
   }else if(portal=='rare'){
       window.open('/portals/rare_biosphere/rare.php',"_self");  
   }else if(portal=='hmp'){
      window.open('/portals/hmp/hmp.php',"_self");   
   }else if(portal=='mobedac'){
      window.open('/portals/mobedac/mobedac.php',"_self");   
   }else{
   
   }
}
</script>
</div>
	
