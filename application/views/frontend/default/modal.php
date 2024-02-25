<!-- Guide Filter Modal -->
	<div class="modal fade guide_modal" id="guideFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Guide Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				    <div class="filter_head">
				       <h2>Filters</h2>
				       <a href="javascript:void(0)" type="button" class="clear">Clear</a>
				    </div>
					<form id="guide_filter" method="post">
						<div class="banner__list">
							<div class="row align-items-center row-cols-1">
								<div class="col mb-4">
									<label>Interested in</label>
									<div class="interested">
                                        <div class="interested_item">
                                          <input type="radio" class="interested_item_radio" name="gender" id="girls" value="girls">
                                          <label for="girls" class="interested_label">Girls</label>
                                        </div>
                                        <div class="interested_item">
                                            <input type="radio" class="interested_item_radio" name="gender" id="boys"  value="boys" checked>
                                            <label for="boys" class="interested_label">Boys</label>
                                        </div>
                                        <div class="interested_item">
                                            <input type="radio" class="interested_item_radio" name="gender" id="both"  value="">
                                            <label for="both" class="interested_label">Both</label>
                                        </div>
                                    </div>
								</div>
								<div class="col mb-4">
									<label>Location</label>
									<div class="banner__inputlist">
										<select id="location" name="location" required>
											<option value="">Select Location</option>
											<?php 
											$this->db->group_by('city'); 
											$query = $this->db->get("guidepal_registration");
											foreach($query->result_array() as $row){ ?>
											<option value="<?php echo $row['city'];?>"><?php echo $row['city'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col mb-4">
								  <div class="rengeSlider">   
                                    <label for="age">Age</label>
                                    <input type="text" id="age" name="age" style="width:80px;text-align: right;">
                                  </div>     
                                    <div id="age-range"></div>	
								</div>
								<div class="col mb-4">
								  <div class="rengeSlider">   
                                    <label for="rent">Rent</label>
                                    <input type="text" id="rent" name="rent" style="width:150px;text-align: right;">
                                  </div>     
                                    <div id="rent-range"></div>	
								</div>
								<div class="col">
									<button type="submit" id="submitbtn" class="default-btn reverse d-block w-100"><span>Continue</span></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- modal -->

<!-- Rent Friend Filter Modal -->
	<div class="modal fade guide_modal" id="rentfriendFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Rent as a Friend Filter</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				    <div class="filter_head">
				       <h2>Filters</h2>
				       <a href="javascript:void(0)" type="button" class="clear">Clear</a>
				    </div>
					<form id="friend_filter" method="post">
						<div class="banner__list">
							<div class="row align-items-center row-cols-1">
								<div class="col mb-4">
									<label>Interested in</label>
									<div class="interested">
                                        <div class="interested_item">
                                          <input type="radio" class="interested_item_radio" name="gender" id="fgirls" value="girls">
                                          <label for="fgirls" class="interested_label">Girls</label>
                                        </div>
                                        <div class="interested_item">
                                            <input type="radio" class="interested_item_radio" name="gender" id="fboys"  value="boys" checked>
                                            <label for="fboys" class="interested_label">Boys</label>
                                        </div>
                                        <div class="interested_item">
                                            <input type="radio" class="interested_item_radio" name="gender" id="fboth"  value="both">
                                            <label for="fboth" class="interested_label">Both</label>
                                        </div>
                                    </div>
								</div>
								<div class="col mb-4">
									<label>Location</label>
									<div class="banner__inputlist">
										<select id="location" name="location">
											<option value="">Select Location</option>
											<?php 
											$this->db->group_by('city'); 
											$query = $this->db->get("rent_friend");
											foreach($query->result_array() as $row){ ?>
											<option value="<?php echo $row['city'];?>"><?php echo $row['city'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col mb-4">
								  <div class="rengeSlider">   
                                    <label for="fage">Age</label>
                                    <input type="text" id="fage" name="age" style="width:75px;text-align: right;">
                                  </div>     
                                    <div id="fage-range"></div>	
								</div>
								<div class="col mb-4">
								  <div class="rengeSlider">   
                                    <label for="frent">Rent</label>
                                    <input type="text" id="frent" name="rent" style="width:150px;text-align: right;">
                                  </div>     
                                    <div id="frent-range"></div>	
								</div>
								<div class="col">
									<button type="submit" id="submitreq" class="default-btn reverse d-block w-100"><span>Continue</span></button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- modal --> 

<div id="chatbot-container" style="display: none;">

  <div id="chatbot-interface">
    <section id="main" class="bg-dark">
		<div id="chat_user_list">
			<div id="user_list" class="py-2">
			</div>
		</div>
		<div id="chatbox" class="hide-chatbox">
		
			<div class="chatting_section" id="chat_area">
				<div id="header" class="">
				    <a id="backChat" href="javascript:void(0)">
				        <i class="fa fa-arrow-left" aria-hidden="true"></i>
				    </a>
				    
					<div id="name_details" class="">
						<div id="chat_profile_image" class="mx-2" style="background-size: 100% 100%">
							<div id="online"></div>
						</div>
						<div id="name_last_seen">
							<h6 class="m-0"></h6>
							<p class="m-0"></p>
						</div>
					</div>
					<!--<div id="icons" class="px-4 pt-2">-->
					<!--	<div id="send_mail">-->
					<!--		<a href="" id="mail_link"><i class="fas fa-envelope text-dark"></i></a>-->
					<!--	</div>-->
					<!--	<div id="details_btn" class="ml-3">-->
					<!--		<i class="fas fa-info-circle text-dark"></i>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<div id="chat_message_area">

				</div>
				<form id="SendMessage">
				<div id="messageBar" class="py-2 px-3">
					<div id="textBox_attachment_emoji_container">
						<div id="text_box_message">
							<input type="text" maxlength = "200" name="txt_message" id="messageText" class="form-control" placeholder="Type your message">
						</div>
						<div id="text_counter">
							<p id="count_text" class="m-0 p-0"></p>
						</div>
					</div>
					<div id="sendButtonContainer">
						<button class="btn"  id="send_message">
							<span class="material-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
						</button>
					</div>
				</div>
				</form>
			</div>
		</div>
		
	</section>
</body>
</html>
  </div>
</div>
