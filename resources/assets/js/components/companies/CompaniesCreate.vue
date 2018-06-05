<template>

    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new company</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Company name</label>
                            <input type="text" v-model="company.name" class="form-control">
                            {{err_msg.name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Company address</label>
                            <input type="text" v-model="company.address" class="form-control">
                            {{err_msg.address}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Company website</label>
                            <input type="text" v-model="company.website" class="form-control">
                            {{err_msg.website}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Company email</label>
                            <input type="text" v-model="company.email" class="form-control">
                            {{err_msg.email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Company image</label>
                            <input type="file" ref="avatar" name="avatar" class="form-control">
                            {{err_msg.avatar}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                company: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                    avatar: ''
                },
                err_msg: [],
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                let app = this;
                let newCompany = new FormData;

                newCompany.append('avatar', this.$refs.avatar.files[0]);
                newCompany.append('name', app.company.name);
                newCompany.append('address', app.company.address);
                newCompany.append('website', app.company.website);
                newCompany.append('email', app.company.email);

                axios.post(
                        '/api/v1/companies', //url
                        newCompany, //data
                        {
                            headers: {'Content-Type':'multipart/form-data' } //headers type
                        }
                    )
                    .then(response => {
                        alert('Company has created');
                    })
                    .catch(error => {
                        app.returnErrorMessage(error.response.data);
                    });
            },
            returnErrorMessage(error) {
                let app = this;
                app.err_msg = [];
                app.err_msg.name = error.name[0];
                app.err_msg.email = error.email[0];
                app.err_msg.address = error.address[0];
                app.err_msg.website = error.website[0];
            },
        }
    }
</script>

