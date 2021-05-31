<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h1>{{message.toUpperCase()}}</h1>
				<button v-if="state === 'default'" class="btn btn-primary" @click="changeState('edit')">Add</button>
				<button v-if="state=== 'edit'" class="btn btn-cancel" @click="changeState('default')">Cancel</button>
				<div v-if="state === 'edit'" class="add-item-form">
					<div class="form-group">
						<input v-model='newItem' type="text" class="form-control" @keyup.enter="saveItem" placeholder="Add new item"/>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" v-bind:disabled="newItem.length === 0" @click="saveItem">Add Item</button>
					</div>
				</div>
				<div>
					<ul>
						<li v-for="detail in details" >
							{{detail}}
						</li>
					</ul>
				</div>
				<div v-if="details.length === 0">Nice job! you have bought all items</div>

			</div>
		</div>
	</div>

</template>

<script>
	export default {
		data(){
			return {
				state:'default',
				message: 'Shopping list app',
				newItem:'',
				details: [
					//'cotton',
					//'polyster'
				],

			}
		},
		methods:{
			saveItem:function(){
				this.details.push(this.newItem);
				this.newItem = '';
			},
			changeState:function (newState) {
				this.state = newState;
			}
		},

	}

</script>