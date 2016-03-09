<?php include_once("ill_subm_beginning.php"); ?>
<?php
  	include_once("ill_subm_functions.php");
  	include_once "ill_subm_filled_variables.php";
?>
       <?php 
	include_once("ill_subm_menu.php");
?>

      <h2>Help and tips</h2>

<ol class="help_list">
<li><span class="emph">If you got a "<span class="message">Path to raw data is empty!</span>" or "<span class="message">Sorry, there is no ini file. Please add a path to raw data.</span>" message:</span>
<ul>
	<li>Check if "path to raw data" is correct, you can write in the field provided. </li>
</ul>
</li>

<li><span class="emph">If you try to upload data to the database and got a "<span class="message">There is 0 sequences in filename = ...</span>" message in your terminal:</span>
<ul>
	<li>Check why the file(s) is empty. That could happen because the previous step haven't finished or because there is an error somewhere (check previous steps and files with the same beginning). If that's only one file and you know that there was just a few sequences to begin with (*_STATS will help) then gzip the files with 0 sequences and the script will ignore them.</li>
</ul>
</li>

<li><span class="emph">If you are processing NextSeq:</span>
<ul>
	<li>If your raw file names start with 'IDX' instead of an actual index run the following in the directory with the raw files on any server:
		<ul>
			<li><span class="green_message">python /bioware/seqinfo/bin/rename_idxnum_to_index.py <i>bacteria v6</i></span></li>
		</ul>
		
		to rename the files. Change <b><i>bacteria v6</i></b> as needed. To get all domain/dna_region available run
		<ul>
			<li><span class="green_message">python /bioware/seqinfo/bin/rename_idxnum_to_index.py -h</span>.</li>
		</ul>
	</li>
	<li>Choose "Does not have NNNN in run_key (NextSeq)" for "has_Ns" when create a csv if needed.</li>
	<li>Choose "hiseq" for "Machine name".</li>
	<li>If you are looking for your csv file it is in hiseq_info/rundate for now.</li>
</ul>
</li>

<li><span class="emph">Is the cluster done?</span>
<ul>
	<li>To check if a cluster is done you can use
	<span class="green_message">check_cluster.py</span></li>
	<li>You also can combine it with <span class="green_message">mail_done</span>, so you'll get an email when there are no more processes with your username are running on the cluster.
	</li>
</ul>
</li>

<li><span class="emph">Are you done with processing the data?</span>
<ul>
	<li>
	  <!-- If data are ready to be uploaded to VAMPS ("VAMPS update" as an opposite to update data to our inner env454 database) -->
    <p>
    When the data are processed, please send an email notification to vamps@mbl.edu with the subject line: "New data are ready".<br/>
    The body of the email should contain:<br/>
    <ul>
    	<li>
      the date of the run,
      </li>
    	<li>
      projects included in the run
      </li>
    	<li>
      and any users requiring access to each project.
      </li>
    Remember, BPC users automatically have access to all projects, other users are provided access to non-public data on a project by project basis.
    </p>
    </ul>    
	</li>
</ul>
</li>

<li><span class="emph">Some useful things:</span>
  <ul>
    <li><span class="green_message">mail_done</span> is an alias in my <span class="green_message">.bash_profile</span> (a file in my home directory, notice the dot in the name), add this <span class="emph">one</span> line changing the email to yours and keep all quotes exactly like this:<br/>
    alias mail_done='echo "The `echo $STY` screen on `hostname` is done with its job." | mail -s "screen on `hostname`" ashipunova@mbl.edu'
    </li>
    <li>to keep your screen log automatically running add <span class="green_message">.screenrc</span> file (notice the dot) to your home directory and then call screen only from here. In the file:<br/>
      shell -${SHELL}<br/>
      defscrollback 10000<br/>
      deflog on<br/>
      logtstamp on<br/>
      screen -t "set_screen" 1 bash -l<br/>
      autodetach on
    </li>
    <li><span class="green_message">screen -R</span><br/>
    will open an existing screen or a new one or a list of screens, depending on what you have opened already.  
    </li>
  </ul>
</li>

</ol> 
		
	

