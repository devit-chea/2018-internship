<div class="container">
	<div class="row">	
		<div class="col-md-2"><a href="<?php echo base_url(); ?>Welcome_IF/supervisor">
			<button type="button" class="btn btn-primary"><i class="mdi mdi-chevron-left"></i>Back</button></a></div>
		<div class="col-md-8">
			<h3 class="text-center text-primary">Edit Superviser</h3>							
		</div>
	</div><br><br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">			
				<div class="body">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-4"><br><br><br><br><br>
							<img class="user" src="<?php echo base_url(); ?>assets/images/user.png" alt=""><br>
							<a class="link" href="#"><span style="margin-left: 22px;">Change Profile Picture</span></a>
						</div>
						<div class="col-md-6">
							<form action="/action_page.php">
								<table><br>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">First Name</label>
										</div> 
										</td>
										<td style="padding: 10px;">
										<div class="form-group">
											<input type="email" class="form-control" id="email" placeholder="First Name">
										</div>
										</td>
									</tr>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">Last Name</label>
										</div> 
										</td>
										<td style="padding: 0 10px 0 10px;">
										<div class="form-group">
											<input type="email" class="form-control" id="email" placeholder="Last Name">
										</div>
										</td>
									</tr>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">Company</label>
										</div> 
										</td>
										<td style="padding: 10px;">
										<div class="form-group">
											<a href="https://www.codingate.com/">Coding Get Website</a>
										</div>
										</td>
									</tr>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">Position</label>
										</div> 
										</td>
										<td style="padding: 10px;">
										<div class="form-group">
											<input type="email" class="form-control" id="email" placeholder="Position">
										</div>
										</td>
									</tr>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">Email</label>
										</div> 
										</td>
										<td style="padding: 10px;">
										<div class="form-group">
											<input type="email" class="form-control" id="email" placeholder="Email">
										</div>
										</td>
									</tr>
									<tr>
										<td> 
											<div class="form-group">
											<label for="email">Phone</label>
										</div> 
										</td>
										<td style="padding: 10px;">
										<div class="form-group">
											<input type="email" class="form-control" id="email" placeholder="Phone Number">
										</div>
										</td>
									</tr>
									<tr>
										<td><a href="<?php echo base_url() ?>/Welcome_IF/supervisor"><button type="button" class="btn btn-outline-success">Save</button></a></td>
										<td><a href="<?php echo base_url() ?>/Welcome_IF/supervisor"><button type="button" class="btn btn-outline-danger float-right">Cancel</button></a></td>
									</tr>
								</table><br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>