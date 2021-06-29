<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>IPG-ISTI</title>
    <link rel="icon" type="image/png" sizes="16x16" href="src/assets/img/brand_logo.png">
    <link rel="stylesheet" href="src/css/color.css">
    <link rel="stylesheet" href="src/css/style.css">
</head>

<body>
    <div id="app">
        <div v-if='!logged' class="container logOrSign" id="LogOrSign">
            <div class="left">
                <div class="frame">
                    <div class="notification" v-if='errMsg.state'>
                        <p>{{errMsg.value}}</p>
                    </div>
                    <div class="inner-box" id="card">
                        <div class="front-card">
                            <div class="in-card">
                                <div class="up">
                                    <h3>Connexion</h3>
                                </div>
                                <div class="down">
                                    <form class="fieldlist">
                                        <input v-model="login.model.usernameOrEmail.value" class="form-input" type="email" placeholder="Pseudo ou adresse electronique">
                                        <input v-model="login.model.password.value" class="form-input" type="password" placeholder="Mot de passe">
                                        <div class="check-case">
                                            <input v-model="login.model.keppConnected.value" type="checkbox" name="rememberMe" id="rememberMe">
                                            <p>Rester connecté</p>
                                        </div>
                                        <input class="form-button" type="button" @click="ToLogin" value="Se Connecter">
                                        <div class="links">
                                            <a class="form-link" @click="openCard('forgotPassword')">Mot de passe oublié ?</a>|<a class="form-link" v-on:click="openRegister()">Créer un compte ?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="back-card">
                            <div class="up">
                                <h3>Inscription</h3>
                            </div>
                            <div class="down">
                                <form action="src/php/process.php" method="post" onsubmit="ToSign()" class="fieldlist">
                                    <input v-model="sigin.model.pseudo.value" class="form-input" type="text" placeholder="Pseudo">
                                    <input v-model="sigin.model.lastName.value" class="form-input" type="text" placeholder="Nom">
                                    <input v-model="sigin.model.firstName.value" class="form-input" type="text" placeholder="Prénom">
                                    <input v-model="sigin.model.email.value" class="form-input" type="email" placeholder="Adresse electronique">
                                    <input v-model="sigin.model.password.value" class="form-input" type="password" placeholder="Mot de passe">
                                    <input v-model="sigin.model.confirmPassword.value" class="form-input" type="password" placeholder="Confirmation mot de passe">
                                    <div class="check-case">
                                        <input v-model="sigin.model.acceptTermsOfUse.value" class="form-checkbox" type="checkbox" name="TermsQuestion" id="TermsQuestion">
                                        <p>J'accepte les <a v-on:click="openCard('acceptTermsOfUse')">termes et politiques de confidentialités </a></p>
                                    </div>
                                    <input class="form-button" type="button" @click="ToSigin()" value="S'inscrire">
                                    <div class="links">
                                        <a class="form-link" v-on:click="openLogin()">Vous êtes déja inscrit ? Connecter vous à votre compte</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="inside">
                    <div class="title">
                        <div class="logo-img">
                            <img class="brand-logo" src="src/assets/img/brand_logo.png" alt="IPG-ISTI Logo">
                        </div>
                        <div class="logo-text">
                            <div class="text-ipg">
                                <h2><span>I</span>nstitut <span>P</span>rive de <span>G</span>estion</h2>
                            </div>
                            <div class="text-isti">
                                <h2><span>I</span>nstitut <span>S</span>uperieur de <span>T</span>echnologie <span>I</span>ndustrielle</h2>
                            </div>
                        </div>
                    </div>
                    <div class="description">
                        <div class="centered">
                            <p>L'école des ingénieurs et techniciens</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="otherCard" v-if="(btnEvent.forgotPassword.state == true || btnEvent.acceptTermsOfUse.state == true)">
                <div class="forgotPassword" v-if="btnEvent.forgotPassword.state">
                    <div class="head">
                        <h1>Récupération de mot de passe</h1>
                        <div class="close">
                            <button v-on:click="closeCard( 'forgotPassword') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                        </div>
                    </div>
                    <div class="body">
                        <div class="input-box">
                            <p>Veuillez confirmez votre addresse pour recevoir un lien de réinitialisation de votre mot de passe</p>
                            <input type="text">
                            <button>Confirmer</button>
                        </div>
                    </div>
                </div>
                <div class="acceptTermsOfUse" v-if="btnEvent.acceptTermsOfUse.state">
                    <div class="head">
                        <h1>Termes et condition d'utilisation</h1>
                        <div class="close">
                            <button v-on:click="closeCard( 'acceptTermsOfUse') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                        </div>
                    </div>
                    <div class="body">
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum soluta corporis sit, inventore harum dignissimos? At impedit omnis consequuntur molestias corporis totam reiciendis ipsum praesentium id, ab officia sit voluptatem tenetur natus aliquid? Itaque saepe nesciunt aspernatur quo asperiores id ea, totam unde blanditiis architecto expedita optio quisquam assumenda eos! Mollitia natus animi sint in beatae atque cupiditate, iure fugit placeat eum expedita totam, aliquam esse quod hic! Sapiente neque ab non veniam ratione, dolorem possimus. Eveniet iusto reprehenderit exercitationem ad vitae corrupti incidunt recusandae quod, est blanditiis ea earum ipsam aut reiciendis maiores atque repellat nam qui autem ex cupiditate rerum amet eaque facere? Itaque aliquam ea necessitatibus neque reprehenderit repudiandae. Nihil maiores facere non et vel, quod nostrum, asperiores omnis quos cupiditate, tempora suscipit? Ex reiciendis minima perferendis odio tempore voluptatibus, quae maiores, nisi quia, aliquam id. Fuga sunt libero tenetur in assumenda quasi reprehenderit, eius consequatur. Eos magnam assumenda blanditiis non recusandae placeat? Voluptatum optio sit dolor at aliquam, labore nobis inventore excepturi a neque corporis voluptas, debitis itaque illo, dolorem est officia quam explicabo. Quas laborum excepturi suscipit odit amet culpa itaque est, magni magnam a in ratione id porro, illo repellendus cumque officiis autem ipsam at temporibus maxime doloribus voluptatibus. Recusandae neque soluta voluptatem earum eum excepturi natus nam nulla, velit voluptatum ipsa itaque sint ad. Illo quia nemo quisquam perspiciatis. Eligendi deleniti beatae illum hic accusamus. Itaque cumque iure et qui id eaque, officiis in, unde vitae rerum saepe aliquid debitis quam illo. Fugiat qui suscipit sint quisquam molestias sunt est soluta neque nisi facilis quis illum iure laborum quibusdam magni corrupti nulla porro sit unde dolor nihil, consequatur delectus totam. Omnis facilis quis ipsam voluptatum temporibus libero, nulla, eligendi, veniam eos ratione expedita consectetur fuga? Aliquam deserunt eum necessitatibus. Porro aperiam inventore labore dolore a neque quidem vel deleniti aliquid reprehenderit, hic quasi ratione corrupti ullam esse repudiandae dolor iure dolorum blanditiis voluptatum alias maiores, autem odit odio. Repudiandae sed, esse illo nam libero unde ut nobis corporis architecto animi error accusamus molestiae vero exercitationem aut aliquam earum facilis. Eligendi consequuntur vel odit obcaecati architecto officia libero aliquam! Dolor delectus, sint quos nulla molestias dicta neque vero, sunt provident aut facilis expedita cupiditate obcaecati explicabo eos suscipit laboriosam officia illo assumenda excepturi! Dolorum odio qui 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" v-if='logged'>
            <header>
                <nav class="nav-bar">
                    <div class="logo">
                        <div class="img">
                            <img src="src/assets/img/brand_logo.png" alt="brand-logo">
                        </div>
                        <div class="logo-text">
                            <div class="text-ipg">
                                <h2><span>I</span>nstitut <span>P</span>rive de <span>G</span>estion</h2>
                            </div>
                            <div class="text-isti">
                                <h2><span>I</span>nstitut <span>S</span>uperieur de <span>T</span>echnologie <span>I</span>ndustrielle</h2>
                            </div>
                        </div>
                    </div>
                    <div class="nav-links">
                        <router-link tag="a" to='/'>
                            <i><img src="src/assets/img/home-1-icon.png"></i>
                            <span>Accueil</span>
                        </router-link>
                        <router-link tag="a" to='/Filiere'>
                            <i><img src="src/assets/img/filiere-1-icon.png "></i>
                            <span>Filiéres</span>
                        </router-link>
                        <router-link tag="a" to='/About'>
                            <i><img src="src/assets/img/about-1-icon.png "></i>
                            <span>A propos</span>
                        </router-link>
                        <router-link tag="a" to='/AccountSetting' id="account">
                            <i><img src="src/assets/img/user-1-icon.png "></i>
                            <span>Compte</span>
                            <strong id="arrow-bar"><img src="src/assets/img/down-arrow.png" alt=""></strong>
                            <div class="account-details " id="account-details">
                                <router-link to="/AccountSetting/AccountInfo">
                                    <i><img src="src/assets/img/settings-1-icon.png "></i>
                                    <span>Accéder à votre compte</span>
                                </router-link>
                                <a href="#switch-account ">
                                    <i><img src="src/assets/img/swap-1-icon.png "></i>
                                    <span>Changer de compte</span>
                                </a>
                                <a href="#logout ">
                                    <i><img src="src/assets/img/logout-1-icon.png "></i>
                                    <span>Se déconnecter</span>
                                </a>
                            </div>
                        </router-link>
                    </div>
                </nav>
            </header>
            <div class="body ">
                <router-view></router-view>
            </div>
        </div>
    </div>

    <script type="text/x-template" id="Home">
        <div class="home-container">
            <div class="school-banner">
                <h1>Ensemble, programons le futur !</h1>
                <router-link tag='a' to='/Filiere'>Voir nos filiéres <img src="src/assets/img/right-arrow-forward.png" alt=""></router-link>
            </div>
        </div>
    </script>

    <script type="text/x-template" id="Filiere">
        <div class="filiere-container">
            <div class="showFiliere">
                <!--Searh & Add Filieres Display-->
                <div class="AddAndSearch">
                    <!--Searh Display-->
                    <div class="search">
                        <img src="src/assets/img/search.png" alt="">
                        <input v-model="searchKey" type="search" id="search" autocomplete="off" placeholder="Rechercher ...">
                        <span v-if="searchKey && filteredList.length >=1" id="resultats">
                                {{filteredList.length}} résultat<span v-if="filteredList.length >= 2">s</span>
                        </span>
                    </div>
                    <!--Searh Display-->
                    <div class="addFiliereBtn">
                        <button type="button" id="btn-add" class="btn-add btn btn-blue" @click="btnEvent.AddFiliere = true">
                            <img src="src/assets/svg/add-button.svg">
                            <span>Nouvelle Filière</span>
                        </button>
                    </div>
                </div>

                <!--Filiere Display-->
                <div v-if="filteredList.length > 0" class="card-card-container">
                    <div class="card-container">
                        <div v-for="filiere in filteredList" class="card">
                            <div class="background-purple">
                                <div class="initiale-filiere" v-on:click="BtnDisplayFiliere(filiere)">
                                    <span>{{filiere.initiale}}</span>
                                </div>
                                <div class="in-card">
                                    <div class=" body-filiere " v-on:click="BtnDisplayFiliere(filiere)">
                                        <div id="description-filiere " class="filiere-div ">
                                            <h5>Description</h5>
                                            <span>{{filiere.description}}</span>
                                        </div>
                                        <div id="year-filiere " class="filiere-div one-line2 ">
                                            <h5>Durée de formation</h5>
                                            <span>{{filiere.year}}ans</span>
                                        </div>
                                        <div id="price-filiere " class="filiere-div one-line2 ">
                                            <h5>Coût de formation</h5>
                                            <span>{{filiere.price}}$</span>
                                        </div>
                                        <div id="price-filiere " class="filiere-div one-line2 ">
                                            <h5>Dilpome requis</h5>
                                            <span>{{filiere.diplome_required}}$</span>
                                        </div>
                                    </div>
                                    <div class="footer ">
                                        <div class="name-filiere ">
                                            <h3>{{filiere.name}}</h3>
                                        </div>
                                        <div class="icon ">
                                            <button id="btn-modify " class="btn-blue " v-on:click="BtnModifyFiliere(filiere) ">
                                                <i><img src="src/assets/img/edit-button.png " alt=" " srcset=" "></i>
                                            </button>
                                            <button id="btn-delete " class="btn-red " v-on:click="BtnDeleteFiliere(filiere) ">
                                                <i><img src="src/assets/img/delete-button.png " alt=" " srcset=" "></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- No result Message-->
                <div v-if="filteredList.length==[] " class="no-result-msg ">
                    <h3>Désolé</h3>
                    <p>Aucune filiére correspondant à <strong>{{searchKey}}</strong></p>
                </div>
            </div>
            <!--Background for Addition Modification or Delete -->
            <div v-if="(btnEvent.AddFiliere || btnEvent.ModifyFiliere || btnEvent.DeleteFiliere || btnEvent.DisplayFiliere) " class="background-option "></div>

            <div class="card-Filere-card ">
                <!--Card for Add a Filiere -->
                <div v-if="btnEvent.AddFiliere " class="addFiliere-Card Filiere-Card ">
                    <div class="header ">
                        <h4>Ajouter Filiére</h4>
                        <button v-on:click="closeCard( 'AddFiliere') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                    </div>
                    <div class="input-box ">
                        <form action=" " class="form ">
                            <div class="one-line ">
                                <div class="input-div ">
                                    <input name="NameFiliere " class="input-box-item " type="text " autocomplete='off' placeholder="Nom Filiere " v-model:value="filiereUsing.name ">
                                    <label class="input-label " for="NameFiliere ">Nom filière</label>
                                </div>
                                <div class="input-div ">
                                    <input class="input-box-item " type="text " autocomplete='off' placeholder="Diplome requis " v-model:value="filiereUsing.diplome_required ">
                                    <label class="input-label " for=" ">Diplome requis</label>
                                </div>
                            </div>
                            <div class="input-div-text-area ">
                                <textarea class="input-box-item " name="description-filiere " id="description-filiere " cols="1 " rows="5 " placeholder="Description Filiere... " v-model:value="filiereUsing.description "></textarea>
                                <label class="input-label " for="description-filiere ">Description filière</label>
                            </div>
                            <div class="one-line ">
                                <div class="input-div ">
                                    <input class=" input-box-item " type="text " autocomplete='off' placeholder="Prix de scolarité " v-model:value="filiereUsing.price ">
                                    <label class="input-label " for=" ">Prix de scolarité</label>
                                </div>
                                <div class="input-div ">
                                    <input class=" input-box-item " type="text " autocomplete='off' placeholder="Durée de formation " v-model:value="filiereUsing.year ">
                                    <label class="input-label " for=" ">Durée de formation</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class=" button-box ">
                        <button id="btn-add " v-on:click="AddFiliere(filiereUsing)" class="btn-green "><img src="src/assets/img/confirm-icon.png " alt=" "> Ajouter</button>
                        <button v-on:click="closeCard( 'AddFiliere')" id="btn-cancel" class="btn-red "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                    </div>
                </div>

                <!--Card for Modify a Filiere -->
                <div v-if=" btnEvent.ModifyFiliere " class="modifyFiliere-Card Filiere-Card ">
                    <div class="header ">
                        <h4>Modifier Filiére</h4>
                        <button v-on:click="closeCard( 'ModifyFiliere') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                    </div>
                    <div class="input-box ">
                        <form action=" " class="form ">
                            <div class="one-line ">
                                <div class="input-div ">
                                    <input name="NameFiliere " class="input-box-item " type="text " autocomplete="off " placeholder="Nom Filiere " v-model:value="newFiliere.name ">
                                    <label class="input-label " for="NameFiliere ">Nom filière</label>
                                </div>
                                <div class="input-div ">
                                    <input class="input-box-item " type="text " autocomplete="off " placeholder="Initiale du filiére " v-model:value="newFiliere.initiale ">
                                    <label class="input-label " for=" ">Initiale du Filiere</label>
                                </div>
                            </div>
                            <div class="input-div-text-area ">
                                <textarea class="input-box-item " name="description-filiere " id="description-filiere " cols="1 " rows="5 " placeholder="Description Filiere... " v-model:value="newFiliere.description "></textarea>
                                <label class="input-label " for="description-filiere ">Description filière</label>
                            </div>
                            <div class="one-line ">
                                <div class="input-div ">
                                    <input class=" input-box-item " type="text " autocomplete="off " placeholder="Prix de scolarité " v-model:value="newFiliere.price ">
                                    <label class="input-label " for=" ">Prix de scolarité</label>
                                </div>
                                <div class="input-div ">
                                    <input class=" input-box-item " type="text " autocomplete="off " placeholder="Durée de formation " v-model:value="newFiliere.year ">
                                    <label class="input-label " for=" ">Durée de formation</label>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class=" button-box ">
                        <button id="btn-modify " v-on:click="UpdateFiliere(newFiliere)" class="btn-green "><img src="src/assets/img/confirm-icon.png " alt=" "> Modifier</button>
                        <button v-on:click="closeCard( 'ModifyFiliere') " id="btn-cancel " class="btn-red "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                    </div>
                </div>

                <!--Card for Delete a Filiere -->
                <div v-if="btnEvent.DeleteFiliere " class="deleteFiliere-Card Filiere-Card small-card ">
                    <div class="header ">
                        <h4>Supprimer Filiére</h4>
                        <button v-on:click="closeCard( 'DeleteFiliere') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                    </div>
                    <div class="input-box ">
                        <h5>Voulez-vous supprimer cette filiére</h5>
                        <p>Nom filiére : <b>{{filiereUsing.name}}</b></p>
                        <p>Description : <b>{{filiereUsing.description}}</b></p>
                        <p>Durée de formation : <b>{{filiereUsing.year}}</b></p>
                        <p>Prix : <b>{{filiereUsing.price}}</b></p>
                    </div>
                    <div class="button-box ">
                        <button class="btn-green" v-on:click="DeleteFiliere(filiereUsing)" id="btn-confirm"><img src="src/assets/img/confirm-icon.png " alt=" "> Confirmer</button>
                        <button v-on:click="closeCard( 'DeleteFiliere') " class=" btn-red " id="btn-cancel "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                    </div>
                </div>

                <!--Card for Display a Filiere -->
                <div v-if="btnEvent.DisplayFiliere " class="displayFiliere-Card Filiere-Card small-card ">
                    <div class="header ">
                        <h4>Affichage Filiére</h4>
                        <button v-on:click="closeCard( 'DisplayFiliere') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                    </div>
                    <div class="input-box body-card ">
                        <p>Nom filiére : <b>{{filiereUsing.name}}</b></p>
                        <p>Description : <b>{{filiereUsing.description}}</b></p>
                        <p>Durée de formation : <b>{{filiereUsing.year}}</b></p>
                        <p>Prix : <b>{{filiereUsing.price}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </script>
    
    <script type='text/x-template'  id='About'>
        <div class="about-container ">
            <div class="text-box ">
                <div>
                    <h1>A propos de l'école</h1>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat sapiente esse voluptatum earum facere odit dolorum autem aperiam aliquam repellendus beatae reiciendis sequi eius, porro culpa laborum accusamus rem! Minus.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat nesciunt, nostrum provident inventore veniam quis id unde laudantium iure, molestiae maxime! Enim quisquam odio ea ipsam iure excepturi, et sapiente? Recusandae vero nam impedit velit culpa, sunt sequi veritatis mollitia natus porro. Voluptate ipsum consequuntur laboriosam explicabo. Illum nam officia deleniti, quia beatae at sunt ducimus iusto excepturi dolores aliquid, expedita id reiciendis voluptate doloribus. Id dolorum et autem rerum?
                    </p>
                </div>
            </div>
            <div class="img-box ">
                <img src="src/assets/img/Foundator.png " alt=" ">
            </div>
        </div>
    </script>
    
    <script type='text/x-template' id='AccountSetting'>
        <div class="accountSetting-container account ">
            <div class="header "></div>
            <div class="body-account ">
                <nav class="nav-link ">
                    <router-link tag='a' to='/AccountSetting/AccountInfo'>
                        <span>Information sur votre compte</span>
                        <i><img src="src/assets/img/about-2-icon.png "></i>
                    </router-link>
                    <router-link tag='a' to='/AccountSetting/AccountSecurity'>
                        <span>Sécurité</span>
                        <i><img src="src/assets/img/security-icon.png "></i>
                    </router-link>
                    <router-link tag='a' to='/AccountSetting/AccountOption'>
                        <span>Options de déconnexion</span>
                        <i><img src="src/assets/img/logout-2-icon.png "></i>
                    </router-link> 
                </nav>
                <div class="view-content ">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </script>
    
    <script type='text/x-template' id='AccountHome'>
        <div class="accountHome-container account-item ">
            <h1>Bienvenue dans les paramétres </h1>
        </div>
    </script>

    <script type='text/x-template' id='AccountInfo'>
        <div class="accountInfo-container account-item ">
            <div class="head ">
                <h1>Information sur votre compte</h1>
            </div>
            <div class="body-item ">
                <div class="box ">
                    <div class="item ">
                        <span>
                            Pseudo : <span>{{CurrentUser.pseudo}}</span>
                        </span>
                    </div> 
                    <div class="item ">
                        <span>
                            Nom : <span>{{CurrentUser.lastName}}</span>
                        </span>
                    </div> 
                    <div class="item ">
                        <span>
                            Prénom : <span>{{CurrentUser.firstName}}</span>
                        </span>
                    </div> 
                    <div class="item ">
                        <span>
                            E-mail : <span>{{CurrentUser.email}}</span>
                        </span>
                    </div>
                    <div class="item ">
                        <span>
                            Date de naissance : <span :class=" {notDefined : BoolWhenNull(CurrentUser.birthday)} ">{{ShowWhenNull(CurrentUser.birthday)}}</span>
                        </span>
                    </div>
                    <div class="item ">
                        <span>
                            Adresse : <span :class=" {notDefined : BoolWhenNull(CurrentUser.address)} ">{{ShowWhenNull(CurrentUser.address)}}</span>
                        </span>
                    </div>
                </div>
                <div class="foot ">
                    <div class="item " v-on:click='btnEvent.EditUser = true'><button>Mettre à jour vos informations</button></div>
                    <div class="item " v-on:click='btnEvent.DeleteUser = true'><button>Supprimer votre compte</button></div>
                </div>
                <div class="background " v-if='(btnEvent.EditUser || btnEvent.DeleteUser )'>
                    <div class="EditInfo ">
                    <div v-if='btnEvent.EditUser' class=" Filiere-Card ">
                        <div class="header ">
                            <h4>Modification des informations personelles</h4>
                            <button v-on:click="closeCard( 'EditUser') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                        </div>
                        <div class="input-box ">
                            <form action=" " class="form ">
                                <div class="one-line ">
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.lastName' name="lastName " class="input-box-item " type="text " autocomplete='off' placeholder="Nom " >
                                        <label class="input-label " >Nom </label>
                                    </div>
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.firstName' class="input-box-item " type="text " autocomplete='off' placeholder="Prénom " >
                                        <label class="input-label">Prénom</label>
                                    </div>
                                </div>
                                <div class="one-line ">
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.pseudo' name=" " class="input-box-item " type="text " autocomplete='off' placeholder="Pseudo " >
                                        <label class="input-label " >Pseudo</label>
                                    </div>
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.email' name=" " class="input-box-item " type="text " autocomplete='off' placeholder="Email " >
                                        <label class="input-label " >Email</label>
                                    </div>
                                    
                                </div>
                                <div class="one-line ">
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.adresse' name=" " class="input-box-item " type="text " autocomplete='off' placeholder="Adresse " >
                                        <label class="input-label " >Adresse</label>
                                    </div>
                                    <div class="input-div ">
                                        <input v-model='CurrentUser.birthday' class="input-box-item " type='date' >
                                        <label class="input-label">Date de naissance</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class=" button-box ">
                            <div class="item ">
                                <button id="btn-edit " class="btn-green " v-on:click='EditUser(CurrentUser)'><img src="src/assets/img/confirm-icon.png " alt=" "> Modifier</button>
                            </div>
                            <div class="item ">
                                <button v-on:click="closeCard( 'EditUser') " id="btn-cancel " class="btn-red "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                            </div>
                        </div>
                    </div>

                    <div v-if="btnEvent.DeleteUser " class=" Filiere-Card small-card ">
                        <div class="header ">
                            <h4>Suppression de Compte</h4>
                            <button v-on:click="closeCard( 'DeleteUser') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                        </div>
                        <div class="input-box ">
                            <h5>Voulez-vous supprimer votre compte ?</h5>
                            <p>Nom : <b>{{CurrentUser.lastName}}</b></p>
                            <p>Prénom : <b>{{CurrentUser.firstName}}</b></p>
                            <p>E-mail : <b>{{CurrentUser.email}}</b></p>
                            <p>Date de naissance : <b>{{ShowWhenNull(CurrentUser.birthday)}}</b></p>
                            <p>Adresse : <b>{{ShowWhenNull(CurrentUser.address)}}</b></p>
                        </div>
                        <div class="button-box ">
                            <div class="item ">
                                <button id="btn-delete " class="btn-green " v-on:click='DeleteUser(CurrentUser)'><img src="src/assets/img/confirm-icon.png " alt=" "> Supprimer</button>
                            </div>
                            <div class="item ">
                                <button v-on:click="closeCard('DeleteUser') " id="btn-cancel " class="btn-red "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                            </div>
                        </div>
                    </div>
                        
                </div>
                </div>
            </div>
        </div>
    </script>
    
    <script type='text/x-template' id='AccountSecurity'>
        <div class="accountSecurity-container account-item ">
            <div class="head ">
                <h1>Sécurité</h1>
            </div>
            <div class="body-item ">
                <div class="box ">
                    <div class="item ">
                        <span>
                            Rester connecté : <span> <input type='checkbox' name="keepConnected " id="keepConnected " v-model='CurrentUser.keepConnected'></span>
                        </span>
                    </div> 
                    <div class="item ">
                        <span class='sub-item'>
                            Mot de passe : 
                        </span>
                        <span class='sub-item'>
                            <input v-bind:type='SecurityPassword.password.type' v-model='CurrentUser.password' disabled> 
                            <div class="button-box ">
                                <button v-on:click="ShowPassword('password')"><img :src='SecurityPassword.password.icon' alt=" " srcset=" "></button>
                                <button v-on:click='btnEvent.ChangePassword = true'><img src="src/assets/img/edit.png " ></button>
                            </div>
                        </span>
                    </div> 
                </div>
                
                <div class="background " v-if='btnEvent.ChangePassword || btnEvent.EnterPassword'>
                    <div class="Security ">
                        <div v-if='btnEvent.ChangePassword' class="Filiere-Card ">
                            <div class="header">
                                <h4>Modification de mot de passe</h4>
                                <button v-on:click="closeCard( 'ChangePassword') " class="btn-close-card btn-red "><i><img src="src/assets/img/close-button.png " alt=" "></i><span>Fermer</span></button>
                            </div>
                            <div class="input-box ">
                                <div  class="form ">
                                    <span class='error-msg' v-if='errorMsg.ErrMsgChangePassword.state'>{{errorMsg.ErrMsgChangePassword.value}}</span>
                                    <div class="body-div">
                                        <div class="input-div ">
                                            <input v-model='SecurityPassword.oldPassword.value' class="input-box-item " :type="SecurityPassword.oldPassword.type" placeholder='Ancien mot de passe'>
                                            <label class="input-label " for=" ">Ancien mot de passe</label>
                                            <button  v-on:click="ShowPassword('oldPassword')"><img :src="SecurityPassword.oldPassword.icon"></button>
                                        </div>
                                        <div class="input-div ">
                                            <input v-model='SecurityPassword.newPassword.value' name=" " class="input-box-item " :type="SecurityPassword.newPassword.type" autocomplete='off' placeholder="Nouveau mot de passe" >
                                            <label class="input-label" >Nouveau mot de passe</label>
                                            <button v-on:click="ShowPassword('newPassword')"><img :src="SecurityPassword.newPassword.icon"></button>
                                        </div>
                                        <div class="input-div ">
                                            <input v-model='SecurityPassword.ConfirmNewPassword.value' class="input-box-item " :type="SecurityPassword.ConfirmNewPassword.type" placeholder='Confirmation nouveau mot de passe'>
                                            <label class="input-label " >Confirmation nouveau mot de passe</label>
                                            <button v-on:click="ShowPassword('ConfirmNewPassword')"><img :src="SecurityPassword.ConfirmNewPassword.icon"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='button-box'>
                                <div class="item ">
                                    <button id="btn-edit " class="btn-green " v-on:click='ChangePassword()'><img src="src/assets/img/confirm-icon.png " alt=" "> Modifier</button>
                                </div>
                                <div class="item ">
                                    <button v-on:click="closeCard( 'ChangePassword') " id="btn-cancel " class="btn-red "><img src="src/assets/img/close-button.png " alt=" "> Annuler</button>
                                </div>
                            </div>
                        </div>
                        <div v-if='btnEvent.EnterPassword' class="too-small-card Filiere-Card ">
                            <div class="header ">
                                <h4>Entrer votre de mot de passe</h4>
                            </div>
                            <div class="input-box ">
                                <div  class="form ">
                                    <div >
                                        <span class='error-msg' v-if='errorMsg.ErrMsgEnterPassword.state'>{{errorMsg.ErrMsgEnterPassword.value}}</span>
                                        <div class="input-div ">
                                            <input v-model='SecurityPassword.EnterPassword.value' name=" " class="input-box-item " :type="SecurityPassword.EnterPassword.type" autocomplete='off' placeholder="Entrer votre mot de passe" >
                                            <label class="input-label " >Entrer votre mot de passe</label>
                                            <button v-on:click="ShowPassword('EnterPassword')"><img :src="SecurityPassword.EnterPassword.icon"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='button-box'>
                                <div class="item ">
                                    <button id="btn-edit " class="btn-green " v-on:click="ConfirmPassword()"><img src="src/assets/img/confirm-icon.png " alt=" "> Confirmer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>
    
    <script type='text/x-template' id='AccountOption'>
        <div class="accountOption-container account-item ">
            <div class="head ">
                <h1>Options de déconnexion</h1>
            </div>
            <div class="body-item ">
                <div class="box-button">
                    <div class="item " v-on:click="ToLogOut()">
                        <img src="src/assets/img/logout-icon.png" alt="">
                        <h1>Se déconnecter</h1>
                    </div> 
                    <div class="item " v-on:click="ToSwitch()">
                        <img src="src/assets/img/swap-1-icon.png" alt="">
                        <h1>Changer de compte</h1>
                    </div> 
                </div>
            </div>
        </div>
    </script>


    
    <link rel="stylesheet " href="src/css/animations.css ">
    <script src="src/js/styleScript.js "></script>
    <script src="src/js/vue.js "></script>
    <script src="src/js/axios.js"></script>
    <script src="src/js/vue.router.js "></script>
    <script src="src/js/main.js "></script>
</body>

</html>