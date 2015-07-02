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



<li><span class="emph">If you are processing NextSeq:</span>
<ul>
	<li>If your raw file names start with 'IDX' instead of an actual index run <span class="green_message">rename_idx_index.sh</span> to rename the files. Run it in the directory with the raw files on any server.</li>
	<li>Choose "Does not have NNNN in run_key (NextSeq)" for "has_Ns" when create a csv.</li>
	<li>Choose "hiseq" for "Machine name".</li>
	<li>If you are looking for your csv file it is in hiseq_info/rundate for now.</li>
</ul>
</li>

<li><span class="emph">Is cluster done?</span>
<ul>
	<li>To check if cluster is done you can use
	<span class="green_message">check_cluster.py</span></li>
	<li>You also can combine it with <span class="green_message">mail_done</span>, so you'll get an email when there are no more processes with your username are running on the cluster.
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
		
	

