<template>
<v-app id="inspire">

    <v-content class="mt-12 pa-12">
    
        <v-container class="mt-12" fluid>
            <v-row align="center" justify="center" class="mt-12">
                <v-col cols="12" sm="8" md="5">
                    <v-card class="elevation-12 mt-12">
                        <v-toolbar color="primary" dark flat>
                            <v-toolbar-title><strong class="font-weight-bold headline spacing">Material Status Monitoring</strong></v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-text-field @keyup.enter="Login()" label="Login" prepend-icon="mdi-account" v-model="username" />
                                <v-text-field @keyup.enter="Login()" label="Password" type="password" prepend-icon="mdi-lock" v-model="password" />
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn rounded color="primary" dark @click="Login()" class="px-4">Sign in</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-content>
</v-app>
</template>

<style scoped>
#inspire {
    background-color: ghostwhite;
}

.spacing {
    letter-spacing: 2px;
}



</style>
<script>
import axios from "axios";

export default {
    data() {
        return
        {
            username: "",
            password: "",
            notificationSystem: 
            {
                options: 
                {
                    success: {
                        position: "bottomRight"
                    },
                    error: {
                        position: "bottomRight"
                    },
                    info: {
                        position: "bottomLeft"
                    },
                }
            },
        };
    },

    created() {
        this.getEmp();
    },

      methods: {

        getEmp() {
            let url = `${this.api}Emp`;
            axios
                .post(url)
                .then(res => {
                    console.log(res.GetData);
                });
        },
        
        Login() {
            let url = `${this.api}Employee`;
            axios
                .post(url, 
                {
                    user: this.username,
                    pass: this.password
                })
                .then(res => {
                    console.log(res.data);
                    if (res.data != "") 
                    {
                        // this.CHANGE_USER_INFO(res.data[0])
                        this.$router.push('/home')
                        // console.log(this.$router)
                        this.$toast.success(res.data[0].EmployeeName, 'Welcome!!', this.notificationSystem.options.success)
                        this.$toast.success(`${this.userInfo.fullName}`, 'Welcome!!', this.notificationSystem.options.success)
                    } 
                    else if (this.username == "") 
                    {
                        this.$toast.error('Input username.', 'Login Failed', this.notificationSystem.options.error)
                    } 
                    else if (this.password == "") {
                        this.$toast.error('Input password.', 'Login Failed', this.notificationSystem.options.error)
                    } 
                    else {
                        this.$toast.error('Username or Password is incorrect.', 'Login Failed', this.notificationSystem.options.error)
                    }
                });
        }
    }
};
</script>
