<template>
    <section>
        <div class="row">
            <navigation-section :userid='userid'
                                :username='userInfo.firstname + " " + userInfo.lastname'
                                :profilepic='userInfo.profile_pic'
                                :unreads='unreads'>
            </navigation-section>
        </div>

        <profile-header></profile-header>
        <br>
        <div class="col-xs-12 card" style="padding-top:20px; margin-bottom:20px">
            <!-- <div class="col-xs-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Basic Informations</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Work and Education</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">About Wahid/Me</a></li>
                </ul>
            </div> -->
            <div style="padding:30px">
                <div class="tab-content form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Name</label>
                        <div class="col-xs-8">
                            {{ userInfo.firstname }} {{ userInfo.lastname }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Email</label>
                        <div class="col-xs-8">
                            {{ userInfo.email }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Birth Day</label>
                        <div class="col-xs-8">  
                            {{ userInfo.bday }} {{ userInfo.bmonth }} {{ userInfo.byear }}  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Gender</label>
                        <div class="col-xs-8">
                            {{ userInfo.gender }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Religion</label>
                        <div class="col-xs-8">
                            {{ userInfo.religion }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">About</label>
                        <div class="col-xs-8">
                            {{ userInfo.about }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button @click='showInfoModal' class="btn btn-xs btn-block btn-info">Edit Info</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal v-if="showModal">        
            <div slot="header">Edit Your Info</div>
            <div slot="body">
                <form class="form-horizontal" @submit.prevent='onSubmit'>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">First Name</label>
                        <div class="col-xs-8">
                          <input v-model="form.firstname" class="form-control input-xs" placeholder="" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Last Name</label>
                        <div class="col-xs-8">
                          <input v-model="form.lastname" class="form-control input-xs" placeholder="" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Email</label>
                        <div class="col-xs-8">
                          <input v-model="form.email" class="form-control input-xs" placeholder="" type="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Bio</label>
                        <div class="col-xs-8">
                            <input v-model="form.bio" class="form-control input-xs">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Birth Day</label>
                        <div class="col-xs-8">  
                            <div class="col-xs-6 col-md-4">
                                <div class="row">
                                    <select v-model="form.bday" class="form-control input-xs">
                                        <option style="display:none">Day</option>
                                        <option v-for="day in 31">{{ day }}</option>
                                    </select>
                                </div>  
                            </div> 
                            <div class="col-xs-6 col-md-8">
                                <div class="row"  style="margin-left: -10px;">
                                    <select v-model="form.bmonth" class="form-control input-xs">
                                        <option style="display:none">Month</option>
                                        <option>January</option>
                                        <option>February</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>
                                    </select>  
                                </div> 
                            </div>               
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Birth Year</label>
                        <div class="col-xs-8">
                            <div class="col-xs-10 col-md-5">
                                <div class="row">
                                    <select v-model="form.byear" class="form-control input-xs">
                                            <option style="display:none">Year</option>
                                            <option v-for="year in years">{{ year }}</option>
                                    </select>
                                </div>
                            </div>                 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Gender</label>
                        <div class="col-xs-8">
                            <select v-model="form.gender" class="form-control input-xs">
                                <option style="display:none">Choose your gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">Religion</label>
                        <div class="col-xs-8">
                          <select v-model="form.religion" class="form-control input-xs">
                                <option style="display:none">Choose your religion</option>
                                <option>Islam</option>
                                <option>Hinduism</option>
                                <option>Buddhism</option>
                                <option>Christianity</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4 control-label">About</label>
                        <div class="col-xs-8">
                            <textarea v-autosize  v-model='form.about' maxlength="150" style="resize:none; overflow:hidden" class="form-control" type="text"></textarea>
                            <span class="limiter">{{ charactersLeft }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 pull-right">
                            <button class="btn btn-xs btn-danger" @click="close">Cancel</button>
                            <button class="btn btn-xs btn-success pull-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </modal>
    </section>
</template>

<script>
    import ProfileHeader from '../components/ProfileHeader';
    import NavigationSection from '../components/NavigationSection';
    import Modal from '../components/Modal';
    export default {
        props:['userid', 'unreads'],

        components: {Modal, ProfileHeader, NavigationSection},
        data() {
           return {
                showModal: false,
                years: [],
                userInfo: [],
                form: new Form({
                    firstname: '', 
                    lastname: '', 
                    email: '', 
                    bio: '',
                    bday: 'Day',
                    bmonth: 'Month',
                    byear: 'Year',
                    gender: 'Choose your gender',
                    religion: 'Choose your religion',
                    about: '',
                    profile_pic: ''
                }),
           } 
        },

        computed: {
            charactersLeft() {
                var chars = this.form.about.length;
                var limit = 150;

                if (chars >= limit) {
                    return "limit reached";
                } else {
                    return (limit - chars) + " / " + limit + " CCharacters remaining";
                }
              }
        },

        created() {
            var yearStart = 1950;
            var yearEnd = 2017;

            while(yearStart < yearEnd+1){
              this.years.push(yearStart++);
            }

            this.getUserInfo();
        },

        methods: {
            onSubmit() {
                this.form.post('/update_basic_info');
                this.showModal = false;
                this.getUserInfo();
            },

            getUserInfo() {
                axios.get('/get_user_info').then(response => this.userInfo = response.data);
            },

            showInfoModal() {
                this.form.firstname = this.userInfo.firstname; 
                this.form.lastname = this.userInfo.lastname; 
                this.form.email = this.userInfo.email; 
                this.form.bio = this.userInfo.bio;
                this.form.bday = this.userInfo.bday;
                this.form.bmonth = this.userInfo.bmonth;
                this.form.byear = this.userInfo.byear;
                this.form.gender = this.userInfo.gender;
                this.form.religion = this.userInfo.religion;
                this.form.about = this.userInfo.about;
                this.form.profile_pic = this.userInfo.profile_pic;


                this.showModal = true;
            },

            close() {
                this.showModal =  false;
            }
        }
    }
</script>