<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php //echo $categroy_manu;?>

							<div class="panel panel-default">
								@foreach($categories as $cat)
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cat->name}}
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($cat->categories as $sub_cat)
											<li><a href="{{$sub_cat->url}}">{{$sub_cat->name}} </a></li>
											@endforeach
										</ul>
									</div>
								</div>
								@endforeach
							</div>
							
						</div><!--/category-products-->
					
						
						
						
						
						
					
					</div>