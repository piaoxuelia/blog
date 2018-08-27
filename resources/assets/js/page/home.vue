<template>
	<ul class="list-ul">
		<li v-for="item in data">
			<h2><a href="">{{item.title}}</a></h2>
			<p class="subhead">{{item.subhead}}</p>
			<p class="context"><a href="">{{item.context}}</a></p>
		</li>
	</ul>
</template>

<style src="../../css/list.css"></style>
<script>
	export default {
		data: function() {
			return {
				counter:1,
				data:[
					{
						title: 'Hello from Component A!',
						subhead:'lsjflksjdlksd',
						context:"sflskdjflskjdflskdjflksjdf"
					},
					{
						title: 'Hello from Component B!',
						subhead:'lsjflksjdlksd',
						context:"sflskdjflskjdflskdjflksjdf"
					}
				]
			}
		},
		props:['msg'],
		mounted:function(){
		  this.$nextTick(function () {

		  })
		},
		methods:{
			doThis: function(){
				this.counter += 1;
			}
		}
	}
	
</script>