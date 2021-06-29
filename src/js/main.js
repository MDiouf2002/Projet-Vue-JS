let filieres = [
    { name: "Bachelor", description: "Diplome francais", year: 3, price: 6000000, initiale: "Bache.", diplome_required: "Bac+2"},
    { name: "BTS", description: "Diplome BTS", year: 3, price: 70000, initiale: "B.T.S.", diplome_required: "Bac+2"},
    { name: "IT", description: "Diplome IT", year: 5, price: 8500000, initiale: "I.T.", diplome_required: "Bac+2"},
    { name: "Electricité", description: "Diplome Eléctricité", year: 4, price: 650000, initiale: "Elect.", diplome_required: "Bac+2"},
    { name: "IG", description: "Diplome informatique de Gestion", year: 2, price: 2000000, initiale: "I.G.", diplome_required: "Bac+2"},
    { name: "National", description: "Diplome national", year: 1, price: 1000000, initiale: "Natio.", diplome_required: "Bac+2"},
    { name: "Thiouna", description: "Shakina", year: 1, price: 1000000, initiale: "T.Lo", diplome_required: "Bac+2"},
    { name: "Maimouna", description: "Samb", year: 1, price: 1000000, initiale: "M.Samb", diplome_required: "Bac+2"},
    { name: "Nullard", description: "Diplome pour les nullards", year: 0, price: 90000000, initiale: "N.U.L.L.", diplome_required: "Bac+2"}
];


let media = { showIcon: 'src/assets/img/show.png', hideIcon: 'src/assets/img/hide.png' };


let user = { Pseudo: 'Mdiouf02', lastName: 'Diouf', firstName: 'Mouhamadou Moustapha', pseudo: 'Mdiouf02', email: 'dioufmouhamed009@gmail.com', password: 'password', birthday: undefined, address: undefined, keepConnected: false };
let emptyUser = { Pseudo: undefined, lastName: undefined, firstName: undefined, pseudo: undefined, email: undefined, password: undefined, birthday:undefined, address: undefined, keepConnected: false };

const Home = {
    template: '#Home',
    name: 'Home',
    data: () => {
        return {}
    }
};

const Filiere = {
    template: '#Filiere',
    name: 'Filiere',
    data: () => {
        return {
            filieres: [],
            errList : [],
            errMsg : '',
            filiereUsing: { name: '', description: '', year: '', price: '', initiale: '', diplome_required: '' },
            newFiliere: undefined,
            searchKey: '',
            btnEvent: { AddFiliere: false, ModifyFiliere: false, DeleteFiliere: false, DisplayFiliere: false }
        }
    },
    computed: {
        filteredList() {
            return this.$root.filieres.filter((filieres) => {
                return filieres.name.toLowerCase().includes(this.searchKey.toLowerCase());
            })
        },

    },

    methods: {
        openCard(cardBtnEvent) {
            if (cardBtnEvent == "AddFiliere") {
                this.btnEvent.AddFiliere = true;
            } else if (cardBtnEvent == "ModifyFiliere") {
                this.btnEvent.ModifyFiliere = true;
            } else if (cardBtnEvent == "DeleteFiliere") {
                this.btnEvent.DeleteFiliere = true;
            } else if (cardBtnEvent == "DisplayFiliere") {
                this.btnEvent.DisplayFiliere = true;
            }
        },

        closeCard(cardBtnEvent) {
            if (cardBtnEvent == "AddFiliere") {
                this.btnEvent.AddFiliere = false;
            } else if (cardBtnEvent == "ModifyFiliere") {
                this.btnEvent.ModifyFiliere = false;
            } else if (cardBtnEvent == "DeleteFiliere") {
                this.btnEvent.DeleteFiliere = false;
            } else if (cardBtnEvent == "DisplayFiliere") {
                this.btnEvent.DisplayFiliere = false;
            }

            this.filiereUsing = { name: '', description: '', year: 0, price: 0, initiale: '', diplome_required: '' };
            
        },
        
        CheckFiliereUsing(){
            let x = this.filiereUsing;
            this.errList = [];
            if(x.name != ''){
                console.log("Name is filled");
                if(x.description != ''){
                    console.log("Description is filled");
                    if(x.year > 0 ){
                        console.log("Years is filled");
                        if(x.price > 0 ){
                            console.log("Price is filled");
                        }
                        else{
                            msg = "Le prix du filiere n'est pas remplis";
                            this.errList.push(msg)
                        }
                    }
                    else{
                        msg = "Durée de formation du filiere n'est remplis";
                        this.errList.push(msg)
                    }
                }
                else{
                    msg = "Description du filiere n'est pas remplis";
                    this.errList.push(msg)
                }
            }
            else{
                msg = "Nom du filiere n'est pas remplis";
                this.errList.push(msg)
            }
            
            if(this.errList.length == 0){
                return true;
            }
            else{
                console.log(this.errList);
                return false
            }
        },
        
        emptyFiliereUsing(){
            this.filiereUsing = { name: '', description: '', year: 0, price: 0, initiale: '', diplome_required: '' };
        },

        AddFiliere(newFiliere) {
            let Exist = 0;
            let filieres = this.$root.filieres;
            for (filiere in filieres) {                  
                if (filieres[filiere].name == newFiliere.name) {
                    Exist++ ; 
                    // console.log("Exist "+ Exist);                
                }
            }


            
            if (Exist == 0 && this.CheckFiliereUsing()) {
                alert("Not Exist");
                this.AddFiliereBD();
                this.$root.fetchData();
                this.emptyFiliereUsing();
            }
            else{
                alert("Exist");
            }
        },
        
        UpdateFiliere(newFiliere) {
            let Exist = 0;
            let filieres = this.$root.filieres;
            for (filiere in filieres) {                  
                if (filieres[filiere].name == newFiliere.name) {
                    Exist++ ; 
                    // console.log("Exist "+ Exist);                
                }
            }
            
            if (Exist == 0 && this.CheckFiliereUsing()) {
                alert("Not Exist");
            }
            else{
                alert("Exist");
                this.UpdateFiliereBD();
                this.$root.fetchData();
                this.emptyFiliereUsing();
                this.closeCard('ModifyFiliere');
            }
        },
        
        DeleteFiliere(oldFiliere) {
            let Exist = 0;
            let filieres = this.$root.filieres;
            for (filiere in filieres) {                  
                if (filieres[filiere].name == oldFiliere.name) {
                    Exist++ ; 
                    // console.log("Exist "+ Exist);                
                }
            }
            
            if (Exist == 0 && this.CheckFiliereUsing()) {
                alert("Not Exist");
            }
            else{
                alert("Exist");
                this.DeleteFiliereBD();
                this.$root.fetchData();
                this.closeCard('DeleteFiliere');
            }
        },

        BtnDisplayFiliere(oldFiliere) {
            this.btnEvent.DisplayFiliere = true;
            this.filiereUsing = oldFiliere;

        },

        BtnModifyFiliere(oldFiliere) {
            this.btnEvent.ModifyFiliere = true;
            this.filiereUsing = JSON.parse(JSON.stringify(oldFiliere));;
            this.newFiliere = JSON.parse(JSON.stringify(oldFiliere));;

        },

        BtnDeleteFiliere(oldFiliere) {
            this.btnEvent.DeleteFiliere = true;
            this.filiereUsing = oldFiliere;

        },

        //For Database Administration
        
        AddFiliereBD(){
            axios.post('src/php/process.php', {action:'AddFiliere',
            name: this.filiereUsing.name,
            description: this.filiereUsing.description,
            year: this.filiereUsing.year,
            price: this.filiereUsing.price,
            initiale: this.filiereUsing.initiale,
            diplome_required: this.filiereUsing.diplome_required}).then(function(response){
                console.log('Sucess adding');
            });
        },
        
        UpdateFiliereBD(){
            axios.post('src/php/process.php', {action:'UpdateFiliere',
            filiere_id: this.filiereUsing.filiere_id,
            name: this.newFiliere.name,
            description: this.newFiliere.description,
            year: this.newFiliere.year,
            price: this.newFiliere.price,
            initiale: this.newFiliere.initiale,
            diplome_required: this.newFiliere.diplome_required}).then(function(response){
                console.log('Success Updating');
                console.log(response.data.message);
            });
        },
        
        DeleteFiliereBD(){
            axios.post('src/php/process.php', {action:'DeleteFiliere',filiere_id: this.filiereUsing.filiere_id}).then(function(response){
                console.log('Sucess Deleting');
            });
        },

    },

    created: () => {
        console.log("I am her!");
    },
    
};


const About = {
    template: '#About',
    name: 'About',
    data: () => {
        return {}
    }
};

const AccountSetting = {
    template: '#AccountSetting',
    name: 'AccountSetting',
    methods: {
        ToLogOut(){
            AccountOption.ToLogOut();
        },

        ToSwitch(){
            AccountOption.ToLogOut();
        }
    }
};

const AccountHome = {
    template: '#AccountHome',
    name: 'AccountHome'
};


const AccountInfo = {
    template: '#AccountInfo',
    name: 'AccountInfo',
    data: () => {
        return {
            CurrentUser: app.user,
            btnEvent: { background: false, EditUser: false, DeleteUser: false }
        }
    },

    computed: {

    },

    methods: {
        ShowWhenNull(value) {
            shd = value;
            if (shd == undefined || shd == '') {
                shd = 'Non Définit';
            }

            return shd;
        },

        BoolWhenNull(value) {
            shd = value;
            rst = false;
            if (shd == undefined || shd == '') {
                rst = true;
            }

            return rst;
        },

        openCard(value) {
            card = value;
            if (card == 'EditUser') {
                this.btnEvent.EditUser = true;
            } else if (card == 'DeleteUser') {
                this.btnEvent.DeleteUser = true;
            }
        },

        closeCard(value) {
            card = value;
            if (card == 'EditUser') {
                this.btnEvent.EditUser = false;
            } else if (card == 'DeleteUser') {
                this.btnEvent.DeleteUser = false;
            }
        },

        ToSiginBD:function(){
            axios.post('src/php/process2.php', {action:'AddUser',
            pseudo : this.sigin.model.pseudo.value,
            lastName : this.sigin.model.lastName.value,
            firstName : this.sigin.model.firstName.value,
            email : this.sigin.model.email.value,
            password : this.sigin.model.password.value
        }).then(function(response){
                // console.log(app.user);
                if(response.data.length > 0){
                    this.app.user = response.data;
                    console.log(response.data);
                }
                else{
                    app.errMsg.state = true;
                }
            });
        },

        EditUser(User) {
            alert('Edit user ' + User.lastName);
        },

        DeleteUser(User) {
            alert('Delete user ' + User.lastName);
        },
    }
};

const AccountSecurity = {
    template: '#AccountSecurity',
    name: 'AccountSecurity',
    data: () => {
        return {
            CurrentUser: user,
            Newuser: {pseudo:'', lastName:'', firstName:'', email:'', password:'', birthday:'', address:'', keepConnected:false },
            btnEvent: { background: false, ChangePassword: false, EnterPassword: true },
            media: { showIcon: 'src/assets/img/show.png', hideIcon: 'src/assets/img/hide.png' },
            SecurityPassword: {
                password: { icon: media.showIcon, type: 'password', value: "password" },
                oldPassword: { icon: media.showIcon, type: 'password', value: '' },
                newPassword: { icon: media.showIcon, type: 'password', value: '' },
                ConfirmNewPassword: { icon: media.showIcon, type: 'password', value: '' },
                EnterPassword: { icon: media.showIcon, type: 'password', value: '' },
            },
            errorMsg: { 
                ErrMsgEnterPassword: { state: false, value: 'Mot de passe incorrect' },
                ErrMsgChangePassword: { state: false, value: '' } 
            }
        }
    },

    methods: {
        openCard(value) {
            card = value;
            if (card == 'ChangePassword') {
                this.btnEvent.ChangePassword = true;
            } else if (card == 'EnterPassword') {
                this.btnEvent.EnterPassword = true;
            }
        },
        
        closeCard(value) {
            card = value;
            if (card == 'ChangePassword') {
                this.btnEvent.ChangePassword = false;
            } else if (card == 'EnterPassword') {
                this.btnEvent.EnterPassword = false;
            }
        },

        ConfirmPassword() {
            if (this.SecurityPassword.EnterPassword.value == this.CurrentUser.password) {
                this.closeCard('EnterPassword');
                this.errorMsg.ErrMsgEnterPassword.state = false
            } else {
                this.errorMsg.ErrMsgEnterPassword.state = true
            }
        },

        ChangePassword() {
            ValueOldPassword = this.SecurityPassword.oldPassword.value;
            ValueNewPassword = this.SecurityPassword.newPassword.value;
            ValueConfirmNewPassword = this.SecurityPassword.ConfirmNewPassword.value;
            if (ValueOldPassword == this.CurrentUser.password) {
                if (ValueNewPassword.length > 7){
                    if (ValueNewPassword == ValueConfirmNewPassword) {
                        this.CurrentUser.password = this.SecurityPassword.newPassword.value; 
                        this.errorMsg.ErrMsgChangePassword.state = false
                        this.closeCard('ChangePassword');
                    } else {
                        this.errorMsg.ErrMsgChangePassword.state = true
                        this.errorMsg.ErrMsgChangePassword.value = 'Les deux nouveaux mot de passe ne correspondent pas !';
                    }
                } else {
                    this.errorMsg.ErrMsgChangePassword.state = true
                    this.errorMsg.ErrMsgChangePassword.value = 'Mot de passe court !';
                }
                
            } else {
                this.errorMsg.ErrMsgChangePassword.state = true
                this.errorMsg.ErrMsgChangePassword.value = 'Ancien mot de passe incorrect !';
            }
        },

        ShowPassword(btnPassword) {
            if (btnPassword == 'password') {
                if (this.SecurityPassword.password.type == 'password') {
                    this.SecurityPassword.password.type = 'text';
                    this.SecurityPassword.password.icon = media.hideIcon;
                } else {
                    this.SecurityPassword.password.type = 'password';
                    this.SecurityPassword.password.icon = media.showIcon;
                }
            } else if (btnPassword == 'newPassword') {
                if (this.SecurityPassword.newPassword.type == 'password') {
                    this.SecurityPassword.newPassword.type = 'text';
                    this.SecurityPassword.newPassword.icon = media.hideIcon;
                } else {
                    this.SecurityPassword.newPassword.type = 'password';
                    this.SecurityPassword.newPassword.icon = media.showIcon;
                }
            } else if (btnPassword == 'oldPassword') {
                if (this.SecurityPassword.oldPassword.type == 'password') {
                    this.SecurityPassword.oldPassword.type = 'text';
                    this.SecurityPassword.oldPassword.icon = media.hideIcon;
                } else {
                    this.SecurityPassword.oldPassword.type = 'password';
                    this.SecurityPassword.oldPassword.icon = media.showIcon;
                }
            } else if (btnPassword == 'ConfirmNewPassword') {
                if (this.SecurityPassword.ConfirmNewPassword.type == 'password') {
                    this.SecurityPassword.ConfirmNewPassword.type = 'text';
                    this.SecurityPassword.ConfirmNewPassword.icon = media.hideIcon;
                } else {
                    this.SecurityPassword.ConfirmNewPassword.type = 'password';
                    this.SecurityPassword.ConfirmNewPassword.icon = media.showIcon;
                }
            } else if (btnPassword == 'EnterPassword') {
                if (this.SecurityPassword.EnterPassword.type == 'password') {
                    this.SecurityPassword.EnterPassword.type = 'text';
                    this.SecurityPassword.EnterPassword.icon = media.hideIcon;
                } else {
                    this.SecurityPassword.EnterPassword.type = 'password';
                    this.SecurityPassword.EnterPassword.icon = media.showIcon;
                }
            }
        },
    }

};

const AccountOption = {
    template: '#AccountOption',
    name: 'AccountOption',
    data: () => {
        return{

        }
    },

    methods: {
        ToLogOut(){
            app.logged = false;
            app.user = emptyUser;
        },

        ToSwitch(){
            app.logged = false;
            app.user = emptyUser;
        }
    }
};



const router = new VueRouter({
    routes: [
        { path: '/', component: Home, name: 'Home' },
        { path: '/Filiere', component: Filiere, name: 'Filiere' },
        { path: '/About', component: About, name: 'About' },
        {
            path: '/AccountSetting',
            component: AccountSetting,
            children: [
                { path: '', component: AccountHome, name: 'AccountHome' },
                { path: 'AccountInfo', component: AccountInfo, name: 'AccountInfo' },
                { path: 'AccountSecurity', component: AccountSecurity, name: 'AccountSecurity' },
                { path: 'AccountOption', component: AccountOption, name: 'AccountOption' }
            ]
        }
    ]
});



const app = new Vue({
    router,
    linkActiveClass: "active",
    data : {
        name :'Diouf',
        logged : false,
        filieres: [],
        users: [],
        user: [],
        currentUser: [],
        login: {
            model : {
                usernameOrEmail : { value: ''},
                password: { value: '', icon: media.showIcon, type: 'password'},
                keppConnected: { value: false}
            }
        },
        
        sigin: {
            model : {
                pseudo : { value: ''},
                lastName : { value: ''},
                firstName : { value: ''},
                email : { value: ''},
                password: { value: '', icon: media.showIcon, type: 'password'},
                confirmPassword: { value: '', icon: media.showIcon, type: 'password'},
                acceptTermsOfUse: { value: ''},
            }
        },
        
        sigin: {
            model : {
                pseudo : { value: 'Mdiouf02'},
                lastName : { value: 'Diouf'},
                firstName : { value: 'Mouhamed'},
                email : { value: 'Check@gmail.com'},
                password: { value: 'test', icon: media.showIcon, type: 'password'},
                confirmPassword: { value: 'test', icon: media.showIcon, type: 'password'},
                acceptTermsOfUse: { value: true},
            }
        },

        errMsg: { state: false, value:''},

        btnEvent: { forgotPassword: {state: false}, acceptTermsOfUse: {state: false}},

        currentUser : user
    },

    methods : {
        forceUpdate(){
            this.$mount();
        },

        ToLogin(){
            let usernameOrEmail = this.login.model.usernameOrEmail.value;
            let password = this.login.model.password.value;
            let keppConnected = this.login.model.keppConnected.value;

            
            if(usernameOrEmail!='' && password!=''){
                this.ToLoginBD();
                this.forceUpdate();
                this.ifUserLogged();
            }
            else{
                this.errMsg.state = true; 
                this.errMsg.value = "Veuillez remplir vos identifiants SVP";
                this.$mount();
            }
        },

        ifUserLogged(){
            if(this.user.user_id != undefined){
                this.logged = true;
            }
            else{
                console.log("Not loged");
            }
        },
        
        ToSign(){
            let pseudo = this.sigin.model.pseudo.value;
            let lastName = this.sigin.model.lastName.value;
            let firstName = this.sigin.model.firstName.value;
            let email = this.sigin.model.email.value;
            let password = this.sigin.model.password.value;
            let confirmPassword = this.sigin.model.confirmPassword.value;
            let acceptTermsOfUse = this.sigin.model.acceptTermsOfUse.value;

            
            if(pseudo != '' && lastName != '' && firstName != '' && email != '' && password != '' && confirmPassword != '' && acceptTermsOfUse){
                this.ToSiginBD();
                this.forceUpdate();
            }
            else{
                this.errMsg.state = true; 
                this.errMsg.value = "Veuillez remplir vos identifiants SVP";
                this.$mount();
            }
        },

        openRegister() {
            let card = document.getElementById("card");
            card.style.transform = "rotateY(-180deg)";
        },
        
        openLogin() {
            let card = document.getElementById("card");
            card.style.transform = "rotateY(0)";
        },

        openCard(card) {
            if (card == 'forgotPassword') {
                this.btnEvent.forgotPassword.state = true;
            } else if (card == 'acceptTermsOfUse') {
                this.btnEvent.acceptTermsOfUse.state = true;
            }
        },
        
        closeCard(card) {
            if (card == 'forgotPassword') {
                this.btnEvent.forgotPassword.state = false;
            } else if (card == 'acceptTermsOfUse') {
                this.btnEvent.acceptTermsOfUse.state = false;
            }
        },

        //Partie Base de données

        fetchData:function(){
            axios.post('src/php/process.php', {action:'fetchFiliere'}).then(function(response){
                app.filieres = response.data;
            }); 
        },
        
        ToLoginBD:function(){
            axios.post('src/php/process2.php', {action:'ConnectUser',
            usernameOrEmail: this.login.model.usernameOrEmail.value,
            password: this.login.model.password.value}).then(function(response){
                // console.log(app.user);
                if(response.data.length > 0){
                    console.log(app.user);
                    app.user = response.data[0];
                    console.log(response.data);
                }
                else{
                    app.errMsg.state = true;
                }
            }); 
        },

        ToSiginBD:function(){
            axios.post('src/php/process2.php', {action:'AddUser',
            pseudo : this.sigin.model.pseudo.value,
            lastName : this.sigin.model.lastName.value,
            firstName : this.sigin.model.firstName.value,
            email : this.sigin.model.email.value,
            password : this.sigin.model.password.value
        }).then(function(response){
                // console.log(app.user);
                if(response.data.length > 0){
                    this.app.user = response.data;
                    console.log(response.data);
                }
                else{
                    app.errMsg.state = true;
                }
            });
        },
        
        fetchUsers:function(){
            axios.post('src/php/process.php', {action:'fetchUsers'}).then(function(response){
                app.users = response.data;
            }); 
        }

    },
    created:function(){
        this.fetchData();
    }


}).$mount('#app');