<style>
	img {
		display:block;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		border-radius: 50%;
		margin: 0 auto;
	}
</style>
<div>
	<img src="{{Session::get('INSTA_USER')->profile_picture}}" alt="">
	
	<pre>{{json_encode(Session::get('INSTA_USER'))}}</pre>
</div>