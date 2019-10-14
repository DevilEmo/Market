<template>
    <div class="users">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>users</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#adduserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New user</span></a>
												
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox5" name="options[]" value="1">
                                <label for="checkbox5"></label>
                            </span>
                        </td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <a :href="'#edituserModal'+user.id" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a :href="'#deleteuserModal'+user.id" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
												<!-- Delete Modal HTML -->
							<div :id="'deleteuserModal' + user.id" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<form>
											<div class="modal-header">						
												<h4 class="modal-title">Delete user</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											</div>
											<div class="modal-body">					
												<p>Are you sure you want to delete these Records?</p>
												<p class="text-warning"><small>This action cannot be undone.</small></p>
											</div>
											<div class="modal-footer">
												<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
												<input type="button" data-dismiss="modal" @click="deleteUser(user.id)" class="btn btn-danger" value="Delete">
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Edit Modal HTML -->
							<div :id="'edituserModal' + user.id" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<form @submit.prevent="editUser(user)" action="#"> 
											<div class="modal-header">						
												<h4 class="modal-title">Edit user</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											</div>
											<div class="modal-body">					
												<div class="form-group">
													<label>Name</label>
													<input v-model="user.name" name="name" type="text" class="form-control" required>
												</div>
												<div class="form-group">
													<label>Email</label>
													<input v-model="user.email" type="text" name="email" class="form-control" required>
												</div>
												<div class="form-group">
													<label>Password</label>
													<input v-model="user.password" type="text" name="password" class="form-control" required>
												</div>					
											</div>
											<div class="modal-footer">
												<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
												<input type="submit" class="btn btn-success" value="Update">
											</div>

										</form>
									</div>
								</div>
							</div>
	

					    </td>
                    </tr>
                </tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b>{{ pagination.current_page }}</b> out of <b>{{pagination.last_page}}</b> entries</div>
                <ul class="pagination">
                    <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a href="#" class="page-link"
                    @click="fetchusers(pagination.prev_page_url)">Previous</a></li>
                    
                    <li class="page-item active"><a href="#" class="page-link">{{ pagination.current_page }}</a></li>
                    
                    <li :class="[{disabled: !pagination.next_page_url}]" class="page-item"><a href="#" class="page-link"
                     @click="fetchusers(pagination.next_page_url)">Next</a></li>
                </ul>
            </div>
        </div>
	<!-- add Modal HTML -->
	<div id="adduserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form @submit.prevent="addUser" action="#">
					<div class="modal-header">						
						<h4 class="modal-title">Add user</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input v-model="user.name" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input v-model="user.email" type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input v-model="user.password" type="password" class="form-control" required>
						</div>							
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	

    </div>
</template>

<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
export default {
name:'users',
data(){
    return{
        users: [],
        user:{
			id: '',
            name: '',
            email: '',
            password: '',
		},
        pagination:{},
    }
  
},
// computed:{
//  	totalstock: function(){
//  		return parseInt(user.stock) + parseInt(user.morestock)
//  	}
//  },
created(){
    this.fetchUsers();
},
methods:{
    fetchUsers(page_url){
        let vm = this;
        page_url = page_url || 'api/users'
        fetch(page_url)
        .then(res => res.json())
        .then(res=>{
            this.users = res.data;
            vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links){
        let pagination = {
            current_page: meta.current_page,
            last_page: meta.last_page,
            next_page_url: links.next,
            prev_page_url: links.prev 
        };
        this.pagination = pagination;
	},
	deleteUser(id){
		fetch(`api/user/${id}`,{
			method: 'delete'
		})
		.then((res) => res.json())
		.then(data => {
			this.fetchUsers();
		})
		.catch(err => console.log(err));
	},
	addUser(){
		fetch('api/user',{
			method: 'post',
			body: JSON.stringify(this.user),
			headers:{
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		})
		.then((res) => res.json())
		.then(data => {
			this.user.name = "";
			this.user.email = "";
			this.user.password = "";
			this.fetchUsers();
		})
		.catch(err => console.log(err));

	},
	editUser(user){
		this.user.id = user.id;
		this.user.name = user.name;
		this.user.email = user.email;
		this.user.password = user.password;

		fetch(`api/user/${this.user.id}`,{
			method: 'put',
			body: JSON.stringify(this.user),
			headers:{
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		})
		.then((res) => res.json())
		.then(data => {
			this.user.name = "";
			this.user.email = "";
			this.user.password = "";
			this.fetchUsers();
		})
		.catch(err => console.log(err));
	}
    }
}
</script>

<style scoped>
.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}
</style>