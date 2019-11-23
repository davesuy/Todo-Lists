<template>
	<div id="todo-list" class="container">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<h1 class="text-center">Dave Todo Lists</h1>

				<form v-on:submit.prevent="addNewTask">
					<label for="tasknameinput">Task Name</label>

					<input v-model="taskname" type="text" id="tasknameinput" class="form-control" placeholder="Add New Task">

					<button v-if="this.isEdit == false" type="submit" class="btn btn-success btn-block mt-3">Add</button>

					<button v-else type="button" v-on:click="updateTask()" class="btn btn-primary btn-block mt-3">Update</button>
				</form>

				<table class="table">
					<tr v-for="(todo) in todos" v-bind:key="todo.id" v-bind:title="todo.title">
						<td>
							<input  v-if="todo.status == 1" checked class="box"   type="checkbox"  name="status"   @change="updateActiveStatus(todo.id, todo.status)" >

							<input v-if="todo.status == 0" class="box"  type="checkbox"  name="status"   @change="updateActiveStatus(todo.id, todo.status)" >

						</td>
						<td class="text-left">{{todo.title}}</td>
						<td class="text-right">
							<button v-on:click="editTask(todo.title, todo.id)" class="btn btn-info">Edit</button>
							<button v-on:click="deleteTask(todo.id)" class="btn btn-danger">Delete</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>	
</template>

<script>
	import axios from 'axios'

	export default {
		data() {
			return {
				todos:[],
				id: '',
				taskname: '',
				isEdit: false,
			
			}
		},
		mounted() {
			this.getTasks()
		},
		methods: {
			getTasks() {
				axios({method: 'GET', url: '/api/tasks'}).then(
					result => {
						console.log(result.data)
						this.todos = result.data
					},
					error => {
						console.error(error)
					}
				)
			},
			addNewTask() {
				axios.post('/api/task', {title: this.taskname}).then(res => {
					this.taskname = ''
					this.getTasks()
					console.log(res)
				})
				.catch(err => {
					console.log(err)
				})
			},
			editTask(title, id) {
				this.id = id
				this.taskname = title
				this.isEdit = true
			},
			updateTask() {
				axios.put(`/api/task/${this.id}`,
				{title: this.taskname})
				.then(res => {
					this.taskname = ''
					this.isEdit = false
					this.getTasks()
					console.log(res)
				})
				.catch(err => {
					console.log(err)
				})
			},
			deleteTask(id) {
				axios.delete(`/api/task/${id}`)
				.then(res => {
					this.taskname= ''
					this.getTasks()
					console.log(res)
				})
				.catch(err => {
					console.log(err)
				})
			},
			updateActiveStatus(id, status) {
				

				if(status == 1) {
					var st = 0;
				} else {
					var st = 1;
				}

				//console.log(st);

				axios.put(`/api/task/status/${id}`, {status: st})
				.then(res => {
		
					console.log(res)
				})
				.catch(err => {
					console.log(err)
				})
			}
		}
	}


</script>