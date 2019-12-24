<div class="member-card card">

    <h3>New Blast Email</h3>


    <div class="row">


        <div class="col-md-12">

        <form id="emailAdminForm" action="../emailblast/admin/BlastEmailproc.php" method="post" enctype="multipart/form-data"  autocomplete="off" >


            <div class="row">


                <div class="col-md-8">


                    <div class="form-group border-b-1">
                        <div class="row">

                            <div class="col-md-1">
                                <label>From:</label>
                            </div>

                            <div class="col-md-11">
                                <input type="text" name="" readonly="true" style="background-color: white" class="form-control border-0" value="<?= $_SESSION['email']?> -  You." />
                                <input type="hidden" name="sender_id" value="<?= $_SESSION['user_id']?>">
                            </div>

                        </div>
                    </div>


            <div class="form-group border-b-1">

                <div class="row">

                    <div class="col-md-1">
                        <label>To:</label>
                    </div>

                    <div class="col-md-11">
                    	<div style="display: inline-block;">
                        	<input name="selectedEmails" type="text" id="emailUids" class="form-control border-0" readonly="true" title="Selected Members/Groups" required/>
                            <input type="hidden" name="receiver_ids">
                            <input type="hidden" name="receiver_type">
                    	</div>
                    	<div style="display: inline-block; margin-left: 20px">
                        	<a href="javascript:void(0)" style="cursor: pointer;" onclick="$('#search_members_email_modal').modal('show')" title="Select Members">Search Members</a>
                    	</div>
                    	<div style="display: inline-block; margin-left: 20px">
                        	<a href="javascript:void(0)" style="cursor: pointer;" onclick="$('#search_groups_email_modal').modal('show')" title="Select Groups">Groups</a>
                    	</div>
                    </div>

                </div>

            </div>


            <div class="form-group border-b-1">
                <div class="row">
                    <div class="col-md-1">
                        <label>Subject:</label>
                    </div>

                    <div class="col-md-11">
                        <input type="text" name="title" id="title" class="form-control border-0" value="<?php echo isset($rec["title"]) ? $rec["title"] : "" ?>" required/>
                    </div>
                </div>
            </div>

            <div class="form-group border-b-1">
                <div class="row">
                    <div class="col-md-1">
                        <label>CC:</label>
                    </div>

                    <div class="col-md-11">
                        <input type="text" name="cc" id="cc" class="form-control border-0" value="test@mkbazaar.co.uk" required/>
                    </div>
                </div>
            </div>

            <div class="form-group border-b-1">
                <div class="row">
                    <div class="col-md-1">
                        <label>Bcc:</label>
                    </div>

                    <div class="col-md-11">
                        <input type="text" name="bcc" id="bcc" class="form-control border-0" value="test@mkbazaar.co.uk" required/>
                    </div>
                </div>
            </div>

            <div class="form-group border-b-1">
                <div class="row">
                    <div class="col-md-1">
                        <label>Banner:</label>
                    </div>

                    <div class="col-md-11">
                        <a onclick="$('#imgInp').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 10px">
                            <i class="fas fa-paperclip"></i>
                            Banner Img
                        </a>
                        <label id="banner_filename" style="margin-left: 10px"></label><span>* 680 X 80</span>
                        <input type="file" id="imgInp" accept="image/*" style="display: none;" name="banner">
                            <script>
                                $('#imgInp').on('change', function(){
                                    $('#banner_filename').text(this.value.replace(/.*[\/\\]/, ''));
                                });
                            </script>

                        <img id="blah" src="#" alt=" Blast Email Banner Image " style=" width: 100%;
                                                                        max-width: 680px;
                                                                        height: auto;
                                                                        background: #dddddd;
                                                                        font-family: sans-serif;
                                                                        font-size: 15px;
                                                                        line-height: 15px;
                                                                        color: #555555!important;
                                                                        margin: auto;
                                                                        display: block;" />
                    </div>
                </div>
            </div>
            
        </div>
    </div>


            <div class="form-group border-b-1">


                <div class="row">


                    <div class="col-md-12">

                    </div>


                </div>


            </div>


            <div>
                <!-- >> File attach section -->
	          	<div class="reply mt-2">

                    <a onclick="$('#my_file').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 10px">
	          		    <i class="fas fa-paperclip"></i>
	          		    Attach Files
	          		</a>&nbsp;<label id="filenameshow" style=""></label>
                    <span> *Max Size is 500KB</span>
	          		<input type="file" id="my_file" style="display: none;" name="attached">
                        <script>
                            $('#my_file').on('change', function(){

                                if(this.files[0].size > 500000){
                                    alert("File size should not be greater than 500Kb");
                                    return false;
                                }
                                else{
                                    $('#filenameshow').text(this.value.replace(/.*[\/\\]/, ''));
                                }
                            });
                        </script>
	            	<div id="summernote"></div>
                    <input type="hidden" name="msg_contents">
	          	</div>
                <!-- <<  -->

                <!-- Msg send -->
	          	<div class="text-right my-3" style="margin-top: 10px">
                    <button type="submit" class="btn btn-primary px-4 cl-fff" name="submit">
                        <i class="fas fa-paper-plane"></i>  SEND
                    </button>
	          	</div>            	
            </div>

        </form>


        </div>

    </div>

</div>

<!-- >> search memebrs modal dialog -->
<div id="search_members_email_modal" class="modal fade" role="dialog" >

    <div class="modal-dialog" style="width:550px; -webkit-transform: translate(0,15%); -o-transform: translate(0,15%); transform: translate(0,15%);">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

               <button type="button" class="close" data-dismiss="modal">&times;</button>

               <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">Members</h2>

            </div>

            <form id="emailMemberTbl_Form" action="#" method="post" enctype="multipart/form-data" autocomplete="off" >

                <div class="modal-body" style="height:100px;">

                    <table id="emailMemberTbl" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                    </table>

                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10" style="text-align: left">
                            <P><b>Selected Members: </b><b id="szRows">0</b> users</P>
                            <textarea id="example-console-rows" class="col-md-12" readonly="true"></textarea>
                            <input type="hidden" name="selectedIds">
                        </div>
                        <div class="col-md-2" style="padding-top: 5px">
                            <button id="Details" style="width: 60px">Details</button>     
                        </div>
                    </div>
                    <div class="col-md-12" align="right" style="padding: 0px">
                        <button id="email_ok" data-dismiss="modal" style="width: 60px">OK</button>                            
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- << end of search_members_email_modal -->

<!-- >> search groups modal dialog -->
<div id="search_groups_email_modal" class="modal fade" role="dialog" >

    <div class="modal-dialog" style="width:500px; -webkit-transform: translate(0,15%); -o-transform: translate(0,15%); transform: translate(0,15%);">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0px">

                <div class="row">
                    <div class="col-md-6" style="padding-top: 10px">
                      <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">Groups</h2> 
                    </div>

                    <div class="col-md-6" style="">
                      <div style="text-align: right">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>                      
                    </div>
                </div>

                <div class="col-md-12" style="padding: 0px">
                    <div style="text-align: right">
                        <a href="javascript:void(0)" class="text-blue" onclick="$('#search_groups_email_modal').modal('hide');$('#add_new_group_modal').modal('show');"><h4>+ Group</h4></a>
                    </div>
                </div>

            </div>

            <form id="emailGroupMemberTbl_Form" action="#" method="post" enctype="multipart/form-data" autocomplete="off" >

                <div class="modal-body" style="height:100px;">

                    <table id="emailGroupTbl" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Group ID</th>
                            <th>Group Name</th>
                          </tr>
                        </thead>

                    </table>

                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-10" style="text-align: left">
                            <P><b>Selected Groups: </b><b id="g_szRows">0</b> groups</P>                                
                            <textarea id="g_example-console-rows" class="col-md-12" readonly="true" style="border: none; background-color: #f6f5f5;"></textarea>
                            <input type="hidden" name="g_selectedIds">
                        </div>
                        <div class="col-md-2" style="padding-top: 5px; padding-left: 0px">
                            <button id="g_Details" style="width: 60px">Details</button>     
                        </div>
                    </div>
                    <div class="col-md-12" align="right" style="padding: 0px">
                        <button id="group_ok" data-dismiss="modal" style="width: 60px;">OK</button>                            
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>
<!-- << end of search_groups_email_modal -->

<!-- >> start of group_users popup -->
<div id="search_groups_users_email_modal" class="modal fade" role="dialog" >

    <div class="modal-dialog" style="width:600px; -webkit-transform: translate(0,15%); -o-transform: translate(0,15%); transform: translate(0,15%);">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0px">

                <div class="row">
                    <div class="col-md-6" style="padding-top: 10px">
                      <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">Group Members</h2> 
                      <a href="javascript:void(0)" onclick="$('#search_groups_users_email_modal').modal('hide');$('#search_groups_email_modal').modal('show');">< Back to Groups</a>
                    </div>

                    <div class="col-md-6" style="">
                      <div style="text-align: right">
                          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                          <a href="javascript:void(0)" class="text-blue" onclick="$('#search_groups_users_email_modal').modal('hide');$('#search_groups_add_users_modal').modal('show');">
                            <h4 style="padding-top: 10px">+ User</h4>
                          </a>
                      </div>                      
                    </div>
                </div>

            </div>
            <div class="modal-body" style="height:100px;">
                <h4 style="display: inline-block;">Board of Directors1</h4>
                <input type="hidden" name="groupID">
                <!-- <a href="javascript:void(0)" style="margin-left: 5px" title="Edit" id="editGroupID"><i class="fas fa-edit"></i></a>  -->
                <a href="javascript:void(0)" style="margin-left: 5px" title="Group Delete" id="delGroupID"><i class="fas fa-trash-alt"></i></a>

                <table id="emailGroupUsersTbl" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th>Users ID</th>
                        <th>Users Name</th>
                        <th>Users Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>                        
                </table>
            </div>

            <div class="modal-footer" style="text-align: left;">
                <a href="javascript:void(0)" onclick="$('#search_groups_users_email_modal').modal('hide');$('#search_groups_email_modal').modal('show');">< Back to Groups</a>
            </div>

        </div>

    </div>

</div>
<!-- << end of search_groups_users_email_modal -->

<!-- >> start of Add users popup -->
<div id="search_groups_add_users_modal" class="modal fade" role="dialog" >

    <div class="modal-dialog" style="width:600px; -webkit-transform: translate(0,15%); -o-transform: translate(0,15%); transform: translate(0,15%);">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0px">

                <div class="row">
                    <div class="col-md-6" style="padding-top: 10px">
                      <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">+ Users</h2> 
                      <a href="javascript:void(0)" onclick="$('#search_groups_add_users_modal').modal('hide');$('#search_groups_users_email_modal').modal('show');">< Back to Group Members</a>
                    </div>

                    <div class="col-md-6" style="">
                      <div style="text-align: right">
                          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                      </div>                      
                    </div>
                </div>

            </div>

        <form id="addUsersGroupTbl_Form" action="#" method="post" enctype="multipart/form-data" autocomplete="off" >

            <div class="modal-body" style="height:100px;">
                <h4 style="display: inline-block;">Select of Users</h4>
                <input type="hidden" name="groupID">

                <table id="addUsersGroupTbl" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                      </tr>
                    </thead>                        
                </table>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-10" style="text-align: left">
                        <P><b>Selected Members: </b><b id="add_user_szRows">0</b> users</P>
                        <textarea id="add_user_example-console-rows" class="col-md-12" readonly="true"></textarea>
                        <input type="hidden" name="add_user_selectedIds">
                    </div>
                    <div class="col-md-2" style="padding-top: 5px">
                        <button id="add_user_Details" style="width: 60px">Details</button>     
                    </div>
                </div>
                <div class="col-md-12" align="right" style="padding: 0px">
                    <button id="add_user_email_ok" data-dismiss="modal" style="width: 60px">OK</button>                            
                </div>
                <div class="col-md-12" style="text-align: left; padding: 0px">
                    <a href="javascript:void(0)" onclick="$('#search_groups_add_users_modal').modal('hide');$('#search_groups_users_email_modal').modal('show');">< Back to Group Members</a>                    
                </div>
            </div>

        </form>

        </div>

    </div>

</div>
<!-- << end of Add users popup -->

<!-- >> start of Add Group popup -->
<div id="add_new_group_modal" class="modal fade" role="dialog" >

    <div class="modal-dialog" style="width:600px; -webkit-transform: translate(0,15%); -o-transform: translate(0,15%); transform: translate(0,15%);">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header" style="padding-bottom: 0px">

                <div class="row">
                    <div class="col-md-6" style="padding-top: 10px">
                      <h2 class="modal-title" style="margin-top:10px; font-size:24px !important;">Add New Group</h2> 
                      <a href="javascript:void(0)" onclick="$('#add_new_group_modal').modal('hide');$('#search_groups_email_modal').modal('show');">< Back to Group</a>
                    </div>

                    <div class="col-md-6" style="">
                      <div style="text-align: right">
                          <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                      </div>                      
                    </div>
                </div>

            </div>

        <form id="addGroupGroupTbl_Form" action="#" method="post" enctype="multipart/form-data" autocomplete="off" >

            <div class="modal-body" style="height:100px;">
                <strong style="display: inline-block;">Group Name :</strong>
                <input type="text" name="NewGroupID" style="margin-top: 5px" placeholder=" Add new group name..." required>

                <table id="addGroupGroupTbl" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th></th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                      </tr>
                    </thead>                        
                </table>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-10" style="text-align: left">
                        <P style="margin: 0px"><b>Selected Members: </b><b id="new_group_szRows">0</b> users</P>
                        <textarea id="new_group_example-console-rows" class="col-md-12" readonly="true"></textarea>
                        <input type="hidden" name="new_group_selectedIds">
                    </div>
                    <div class="col-md-2" style="padding-top: 5px">
                        <button id="new_group_Details" style="width: 60px">Details</button>     
                    </div>
                </div>
                <div class="col-md-12" align="right" style="padding: 0px">
                    <button id="new_group_email_ok" data-dismiss="modal" style="width: 60px">OK</button>                            
                </div>
                <div class="col-md-12" style="text-align: left; padding: 0px">
                    <a href="javascript:void(0)" onclick="$('#add_new_group_modal').modal('hide');$('#search_groups_email_modal').modal('show');">< Back to Group</a>                    
                </div>
            </div>

        </form>

        </div>

    </div>

</div>
<!-- << end of Add Group popup -->

<style type="text/css">
img#blah[src=""] {
  display:none!important;
}
</style>


<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'summernote' );
  $('#reply_preview_email').click(function(e){
  		$(this).css('display', 'none');
  		$('#reply_send_box').show();
  });

</script>
<style type="text/css">
    textarea{border: none; background-color: #e6e6e6;} 
</style>