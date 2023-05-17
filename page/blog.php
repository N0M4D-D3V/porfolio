<?php  

	global $Nostalgia;

	if(!@is_object($Nostalgia)) 
	{
		require_once('../class/Nostalgia.class.php'); 
		$Nostalgia=new Nostalgia();
	}
?>

<div class="page-blog clear-fix">
	
	<h1>Blog</h1>
	
	<!-- Category list -->
	<div class="layout-50 clear-fix">
		<div class="layout-50-left">
			<ul class="blog-category-list">
				<li><a href="#">General <strong>[26]</strong></a></li>
				<li><a href="#">News <strong>[3]</strong></a></li>
				<li><a href="#">Photography <strong>[6]</strong></a></li>
			</ul>
		</div>
		<div class="layout-50-right">
			<ul class="blog-category-list">
				<li><a href="#">Productivity <strong>[4]</strong></a></li>
				<li><a href="#">Communication <strong>[5]</strong></a></li>
				<li><a href="#">Featured <strong>[11]</strong></a></li>
			</ul>			
		</div>
	</div>
	<!-- /Category list -->

	<!-- Post list -->
	<ul class="blog-list">
		
		<!-- Post -->
		<li class="blog-list-post">
			
			<!-- Post header + date -->
			<div class="blog-list-post-header clear-fix">
				<h3><a href="<?php $Nostalgia->_getURL('post.html'); ?>">Aliquam vitae augue non mi</a></h3>
				<span><span class="month">03</span>17</span>
			</div>
			<!-- /Post header + date -->
			
			<!-- Post image -->
			<div class="blog-list-post-image clear-fix">
				
				<!-- Image -->
				<a href="media/image/_sample/blog_img1.jpg" class="fancybox-image">
					<img src="media/image/_sample/blog_thumb_img1.jpg" alt=""/>
					<span></span>
				</a>
				<!-- /Image -->

				<!-- Caption -->
				<div class="caption clear-fix">
					
					<!-- Category -->
					<span class="category icon-2 icon-2-4">
						in <a href="#">News</a>
					</span>
					<!-- /Category -->
					
					<!-- Author -->
					<span class="author icon-2 icon-2-5">
						by <a href="#">Keith</a>
					</span>
					<!-- /Author -->
					
					<!-- Comment count -->
					<span class="comment icon-2 icon-2-6">
						this entry has <a href="#">2 comments</a>
					</span>
					<!-- /Comment count -->

				</div>
				<!-- /Caption -->				
				
			</div>
			<!-- /Post image -->
			
			<!-- Post content -->
			<p class="blog-list-post-content clear-fix">
				Pellentesque sodales porta est, mattis placerat ligula blandit quis. In posuere consectetur eleifend. 
				Integer at erat nunc, in rhoncus risus. Nulla facilisi. 
				Aenean ultricies, neque nec pharetra volutpat, nunc tellus lacinia nunc, et accumsan eros nunc non tellus. 
				Donec sed ullamcorper tortor. Suspendisse at ante ut tellus lacinia ultricies. Mauris aliquet pharetra leo tempus sagittis.
				<br/><a href="<?php $Nostalgia->_getURL('post.html'); ?>" class="read-more">Read more</a>
			</p>
			<!-- /Post content -->
			
		</li>
		<!-- /Post -->		
		
		<li class="blog-list-post">
			
			<div class="blog-list-post-header clear-fix">
				<h3><a href="<?php $Nostalgia->_getURL('post.html'); ?>">Phasellus tellus vehicula</a></h3>
				<span><span class="month">03</span>09</span>
			</div>
			
			<div class="blog-list-post-image clear-fix">
				
				<a href="media/image/_sample/blog_img2.jpg" class="fancybox-image">
					<img src="media/image/_sample/blog_thumb_img2.jpg" alt=""/>
					<span></span>
				</a>
				<div class="caption clear-fix">
					<span class="category icon-2 icon-2-4">
						in <a href="#">General</a>
					</span>
					<span class="author icon-2 icon-2-5">
						by <a href="#">Brian</a>
					</span>
					<span class="comment icon-2 icon-2-6">
						this entry has <a href="#">5 comments</a>
					</span>
				</div>
				
			</div>
			
			<p class="blog-list-post-content clear-fix">
				Sed sit amet aliquet sem. Phasellus non auctor est. 
				Suspendisse tristique massa at risus ultrices eget consequat purus vulputate. 
				Nulla vestibulum, lorem ac condimentum interdum, est nunc feugiat velit, et adipiscing erat purus eget mi. 
				Curabitur ac turpis massa. Phasellus ac gravida ante. 
				Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
				Pellentesque non libero nec augue ultricies ornare.
				<br/><a href="<?php $Nostalgia->_getURL('post.html'); ?>" class="read-more">Read more</a>
			</p>
			
		</li>
		
		<li class="blog-list-post">
			
			<div class="blog-list-post-header clear-fix">
				<h3><a href="<?php $Nostalgia->_getURL('post.html'); ?>">Cras lacinia orci facilisis</a></h3>
				<span><span class="month">02</span>27</span>
			</div>
			
			<div class="blog-list-post-image clear-fix">
				
				<a href="http://www.youtube.com/watch?v=Zln9I9IttLA" class="fancybox-video fancybox-video-youtube">
					<img src="media/image/_sample/blog_thumb_img3.jpg" alt=""/>
					<span></span>
				</a>
				<div class="caption clear-fix">
					<span class="category icon-2 icon-2-4">
						in <a href="#">Communication</a>
					</span>
					<span class="author icon-2 icon-2-5">
						by <a href="#">Joe</a>
					</span>
					<span class="comment icon-2 icon-2-6">
						this entry has <a href="#">0 comments</a>
					</span>
				</div>
				
			</div>
			
			<p class="blog-list-post-content clear-fix">
				Nulla facilisi. Etiam vehicula lobortis nulla, sit amet egestas urna consequat scelerisque. 
				Suspendisse lobortis purus sed sapien convallis a porttitor nunc mattis. Duis at vestibulum dui. 
				In et commodo augue. Etiam tempor ornare lacinia. Ut lacinia consectetur luctus. 
				Donec condimentum purus sit amet est rutrum laoreet. Mauris id semper urna.
				<br/><a href="<?php $Nostalgia->_getURL('post.html'); ?>" class="read-more">Read more</a>
			</p>
					
		</li>
		
		<li class="blog-list-post">
			
			<div class="blog-list-post-header clear-fix">
				<h3><a href="<?php $Nostalgia->_getURL('post.html'); ?>">Vivamus tempor er porttitor</a></h3>
				<span><span class="month">02</span>12</span>
			</div>
			
			<div class="blog-list-post-image clear-fix">
				
				<a href="http://player.vimeo.com/video/10470386" class="fancybox-video fancybox-video-vimeo">
					<img src="media/image/_sample/blog_thumb_img4.jpg" alt=""/>
					<span></span>
				</a>
				<div class="caption clear-fix">
					<span class="category icon-2 icon-2-4">
						in <a href="#">Photography</a>
					</span>
					<span class="author icon-2 icon-2-5">
						by <a href="#">Keith</a>
					</span>
					<span class="comment icon-2 icon-2-6">
						this entry has <a href="#">10 comments</a>
					</span>
				</div>
				
			</div>
			
			<p class="blog-list-post-content clear-fix">
				Aenean non semper justo. Curabitur ligula enim, consectetur eget lacinia elementum, sodales sit amet ante. 
				Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
				Nullam pellentesque placerat quam, ut ultrices ipsum elementum nec. Nam vitae aliquam lectus. 
				Ut cursus feugiat dolor, in consectetur tellus elementum et. Etiam sed quam ac risus interdum consequat sit amet et nisl.
				<br/><a href="<?php $Nostalgia->_getURL('post.html'); ?>" class="read-more">Read more</a>
			</p>
			
		</li>
		
	</ul>
	<!-- /Post list -->
	
	<!-- Pagination -->
	<ul class="pagination clear-fix">
		<li><a href="#">1</a></li>
		<li><a href="#" class="selected">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
	</ul>
	<!-- /Pagination -->
	
</div>