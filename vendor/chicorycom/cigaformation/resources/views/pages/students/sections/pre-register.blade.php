<template class="task-template">
    <section id="{{ $view }}">
        <div class="welcome">
            <h2 class="twenty">
                Formulaire de pré-inscription
            </h2>

            <div class="row jumbotron">
               <div class="col-md-12">
                   <form class="needs-validation" novalidate>
                        <div class="card ">
                            <div class="card-header">
                               <h4>Antécédents scolaires</h4>
                            </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-check-label" for="invalidCheck">
                                                    Avez-vous déjà fréquenté CIGA-FORMATION ?
                                                </label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="ciga_frequency" id="exampleRadios1" value="OUI" required>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        OUI
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ciga_frequency" id="exampleRadios2" value="NON" required>
                                            <label class="form-check-label" for="exampleRadios2">
                                                NON
                                            </label>
                                            <div class="invalid-feedback">
                                                Vous devez preciser si vous avez dejas frequanté notre etablissement
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 student" style="display: none">
                                            <div class="form-group">
                                                <label for="lastYaer">Votre dernière année de fréquentation ? </label>
                                                <input type="text" name="lastYaer" class="form-control" id="lastYaer" >
                                            </div>
                                        </div>
                                        <div class="col-md-6 noStudent" style="display: none">
                                            <div>
                                                <h6>Etudes antérieures</h6>
                                                <small>Commencer par le dernier établissement fréquenté</small>
                                               <div class="form-row">
                                                   <div class="col-md-7 mb-3">
                                                       <label for="school-name">Nom de l'école</label>
                                                       <input type="text" name="school_name" class="form-control" id="school-name" >
                                                   </div>
                                                   <div class="col-md-5 mb-3">
                                                       <label for="school-address">Localité de l'école</label>
                                                       <input type="text" name="school_address" class="form-control" id="school-address" >
                                                   </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row student" style="display: none">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="validationCustom01">A quel Institut ? </label>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="which_institute" id="which_Guediaway" value="Guediawaye">
                                                    <label class="form-check-label" for="which_Guediaway">Campus Guediawaye</label>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" type="radio" name="which_institute" id="which_Malika" value="Malika">
                                                    <label class="form-check-label" for="which_Malika">Campus Malika</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                           <div class="form-group">
                                               <label for="registration_number">Votre numéro de matricule </label>
                                               <input type="text" class="form-control" name="code" id="registration_number">
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-row noStudent" style="display: none">
                                        <div class="col-md-2 mb-3">
                                            <label for="entry_date">Date entrée</label>
                                            <input type="date" class="form-control" name="entry_date" id="entry_date"  required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="release_date">Date sortie</label>
                                            <input type="date" class="form-control" name="release_date" id="release_date" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="level_reached">Diplôme ou niveau atteint</label>
                                            <input type="text" class="form-control" name="level_reached" id="level_reached" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Copy Diplôme ou bulletin</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="level_reached_file" id="level_reached_file" required>
                                                <label class="custom-file-label" for="level_reached_file">Choose file...</label>
                                                <div class="invalid-feedback">Copy Diplôme ou bulletin</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card border-0">
                                        <div class="card-header border-0">
                                            <h5>Admission demandée</h5>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3 ">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Campus choisi </label>
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="radio" name="campus" id="campus_guediaway" value="Guediawaye" required>
                                                        <label class="form-check-label" for="campus_guediaway">Guediawaye</label>
                                                    </div>
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="radio" name="campus" id="campus_malika" value="Malika" required>
                                                        <label class="form-check-label" for="campus_malika">Malika</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="promotion_date">Année scolaire </label>
                                                    <input type="date"  name="promotion_date" class="form-control" id="promotion_date" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="programme">Programme</label>
                                                    <select name="programme" id="programme" class="form-control" required>
                                                        <option value="">--------</option>
                                                        <optgroup label="Masters| Sciences de la gestion ">
                                                            <option value="Masters >  Marketing &amp; Communication">Masters &gt;  Marketing &amp; Communication</option>

                                                            <option value="Masters > Banque Finance Assurance">Masters &gt; Banque Finance Assurance</option>

                                                            <option value="Masters > Commerce International - Transport et Logistique">Masters &gt; Commerce International - Transport et Logistique</option>

                                                            <option value="Masters > Comptabilité Audit et Contrôle de Gestion">Masters &gt; Comptabilité Audit et Contrôle de Gestion</option>

                                                            <option value="Masters > Gestion de Projet">Masters &gt; Gestion de Projet</option>

                                                            <option value="Masters > Gestion des Ressources Humaines">Masters &gt; Gestion des Ressources Humaines</option>

                                                            <option value="Masters > Ingénierie Financière">Masters &gt; Ingénierie Financière</option>

                                                            <option value="Masters > Management Juridique et Fiscal">Masters &gt; Management Juridique et Fiscal</option>

                                                        </optgroup>
                                                        <optgroup label="Licences| Sciences de la gestion ">

                                                            <option value="Licences > Administration des entreprises et Gestion de Projet">Licences &gt; Administration des entreprises et Gestion de Projet</option>

                                                            <option value="Licences > Banque Finance Assurance">Licences &gt; Banque Finance Assurance</option>

                                                            <option value="Licences > Commerce International - Transport Logistique">Licences &gt; Commerce International - Transport Logistique</option>

                                                            <option value="Licences > Comptabilité Audit et Contrôle de Gestion">Licences &gt; Comptabilité Audit et Contrôle de Gestion</option>

                                                            <option value="Licences > Gestion des Entreprises">Licences &gt; Gestion des Entreprises</option>

                                                            <option value="Licences > Gestion des Ressources Humaines">Licences &gt; Gestion des Ressources Humaines</option>

                                                            <option value="Licences > Management Juridique et Fiscal">Licences &gt; Management Juridique et Fiscal</option>

                                                            <option value="Licences > Marketing &amp; Communication">Licences &gt; Marketing &amp; Communication</option>

                                                        </optgroup>
                                                        <optgroup label="B.T.S| Sciences de la gestion ">

                                                            <option value="B.T.S > B.T.S Comptabilité-Gestion">B.T.S &gt; B.T.S Comptabilité-Gestion</option>

                                                        </optgroup>
                                                        <optgroup label="B.E.P| Sciences de la gestion ">

                                                            <option value="B.E.P > Comptabilité">B.E.P &gt; Comptabilité</option>

                                                        </optgroup>
                                                        <optgroup label="Série G - Comptabilité| Sciences de la gestion ">

                                                            <option value="Série G - Comptabilité > 2nde G, 1ère G et Terminale G">Série G - Comptabilité &gt; 2nde G, 1ère G et Terminale G</option>

                                                        </optgroup>
                                                        <optgroup label="B.T| Sciences de la gestion ">

                                                            <option value="B.T >  (BT.CIM) Brevet de technicien en Commerce International et Marketing">B.T &gt;  (BT.CIM) Brevet de technicien en Commerce International et Marketing</option>

                                                            <option value="B.T > B.T Comptabilité">B.T &gt; B.T Comptabilité</option>

                                                            <option value="B.T > BT Bureautique">B.T &gt; BT Bureautique</option>

                                                        </optgroup>
                                                        <optgroup label="C.A.P| Sciences de la gestion ">

                                                            <option value="C.A.P > Secrétariat-Informatique-Anglais">C.A.P &gt; Secrétariat-Informatique-Anglais</option>

                                                        </optgroup>
                                                        <optgroup label="D.I.C| Sciences de la gestion ">

                                                            <option value="D.I.C > Comptabilité">D.I.C &gt; Comptabilité</option>

                                                        </optgroup>
                                                        <optgroup label="Masters| Sciences &amp; Technologies ">

                                                            <option value="Masters >  Informatique de Gestion ">Masters &gt;  Informatique de Gestion </option>

                                                            <option value="Masters > Administration Système Réseau et Maintenance">Masters &gt; Administration Système Réseau et Maintenance</option>

                                                            <option value="Masters > Electromécanique Electrotechnique - Froid et Climatisation">Masters &gt; Electromécanique Electrotechnique - Froid et Climatisation</option>

                                                            <option value="Masters > Informatique Electronique Industrielle">Masters &gt; Informatique Electronique Industrielle</option>

                                                        </optgroup>
                                                        <optgroup label="Licences| Sciences &amp; Technologies ">

                                                            <option value="Licences >  Génie Civil Bâtiment&nbsp;: Géométre-Topographe">Licences &gt;  Génie Civil Bâtiment&nbsp;: Géométre-Topographe</option>

                                                            <option value="Licences > Administration Système Réseau et Maintenance">Licences &gt; Administration Système Réseau et Maintenance</option>

                                                            <option value="Licences > Electromécanique Electrotechnique- Froid et Climatisation">Licences &gt; Electromécanique Electrotechnique- Froid et Climatisation</option>

                                                            <option value="Licences > Génie Civil Bâtiment&nbsp;: Projecteur-Calculateur BTP">Licences &gt; Génie Civil Bâtiment&nbsp;: Projecteur-Calculateur BTP</option>

                                                            <option value="Licences > Informatique de Gestion">Licences &gt; Informatique de Gestion</option>

                                                            <option value="Licences > Informatique Electronique Industrielle">Licences &gt; Informatique Electronique Industrielle</option>

                                                        </optgroup>
                                                        <optgroup label="B.T.S| Sciences &amp; Technologies ">

                                                            <option value="B.T.S > Electricité d’Installation Industrielle">B.T.S &gt; Electricité d’Installation Industrielle</option>

                                                            <option value="B.T.S > Informatique de Gestion">B.T.S &gt; Informatique de Gestion</option>

                                                            <option value="B.T.S > Informatique Electronique Industrielle">B.T.S &gt; Informatique Electronique Industrielle</option>

                                                        </optgroup>
                                                        <optgroup label="D.T.S| Sciences &amp; Technologies ">

                                                            <option value="D.T.S > Administration Système Réseau et Maintenance">D.T.S &gt; Administration Système Réseau et Maintenance</option>

                                                            <option value="D.T.S > Informatique de Gestion">D.T.S &gt; Informatique de Gestion</option>

                                                        </optgroup>
                                                        <optgroup label="B.T| Sciences &amp; Technologies ">

                                                            <option value="B.T > Electricité de Bâtiment">B.T &gt; Electricité de Bâtiment</option>

                                                        </optgroup>
                                                        <optgroup label="D.I.T| Sciences &amp; Technologies ">

                                                            <option value="D.I.T > Électromécanique Électrotechnique - Froid et Climatisation,  ">D.I.T &gt; Électromécanique Électrotechnique - Froid et Climatisation,  </option>

                                                            <option value="D.I.T > Informatique Electronique Industrielle">D.I.T &gt; Informatique Electronique Industrielle</option>

                                                        </optgroup>
                                                        <optgroup label="D.I.C| Sciences &amp; Technologies ">

                                                            <option value="D.I.C > Electromécanique Electrotechnique- Froid et Climatisation">D.I.C &gt; Electromécanique Electrotechnique- Froid et Climatisation</option>

                                                            <option value="D.I.C > Informatique Electronique Industrielle">D.I.C &gt; Informatique Electronique Industrielle</option>

                                                        </optgroup>
                                                        <optgroup label="DT Spécialisé| Sciences &amp; Technologies ">

                                                            <option value="DT Spécialisé > Mécanique Automobile">DT Spécialisé &gt; Mécanique Automobile</option>

                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0">
                                            <div class="card-header border-0">
                                                <h5>Identification</h5>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name">Prenom </label>
                                                        <input type="text" name="first_name" class="form-control" id="first_name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Nom </label>
                                                        <input type="text" name="last_name" class="form-control" id="last_name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="birthday">Date de naissance </label>
                                                        <input type="date" name="birthday" class="form-control" id="birthday" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="place_birth">Lieu de naissance </label>
                                                        <input type="text" name="place_birth" class="form-control" id="place_birth" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nationality">Nationalité </label>
                                                        <input type="text" name="nationality" class="form-control" id="nationality" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nationality">Genre </label>
                                                       <div>
                                                           <div class="custom-control custom-radio custom-control-inline">
                                                               <input type="radio" id="customRadioInline1" name="customRadioInline1" value="Masculin" class="custom-control-input" required>
                                                               <label class="custom-control-label" for="customRadioInline1">Masculin</label>
                                                           </div>
                                                           <div class="custom-control custom-radio custom-control-inline">
                                                               <input type="radio" id="customRadioInline2" name="customRadioInline1" value="Féminin" class="custom-control-input" required>
                                                               <label class="custom-control-label" for="customRadioInline2">Féminin</label>
                                                           </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Adresse complète </label>
                                                        <input type="text" name="address" class="form-control" id="address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="city">Ville </label>
                                                        <input type="text" name="city" class="form-control" id="city" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="country">Pays </label>
                                                        <select name="country" id="country" class="form-control" required>
                                                            <option value="" selected>---</option>
                                                            <option value="Senegal" >Senegal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email </label>
                                                        <input type="email" name="email" class="form-control" id="email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Téléphone </label>
                                                        <input type="text" name="phone" class="form-control" id="phone" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button class="btn btn-default" type="reset"><h4><i class="fa fa-refresh"></i></h4> Annulé</button>
                                <button class="btn btn-primary" type="submit"><h4><i class="fa fa-save"></i></h4> Enregistré</button>
                            </div>
                        </div>
                   </form>
                 </div>
            </div>
        </div>
    </section>
</template>

<script type='text/javascript'>
    (function() {
        'use strict';
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.ciga_frequency.forEach(el => {
                    el.addEventListener('change', function(){
                        if(this.value === 'OUI'){
                            document.querySelectorAll('.student').forEach(el=>{
                                el.style.display = 'flex'
                            });
                            document.querySelectorAll('.noStudent').forEach(el=>{
                                el.style.display = 'none'
                            });
                        }else {

                            document.querySelectorAll('.student').forEach(el=>{
                                el.style.display = 'none'
                            });
                            document.querySelectorAll('.noStudent').forEach(el=>{
                                el.style.display = 'flex'
                            });
                        }
                    })
                });
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopPropagation();


                   // console.log(form.checkValidity())
                    if (form.checkValidity() === false) {


                    }
                    form.classList.add('was-validated');

                }, false);
            });

        const $country = document.getElementById('country');
        window.country.forEach(data=>{
            const $option = document.createElement('option');
            $option.value = data.name;
            $option.text = data.name ;
            $country.appendChild($option)
        })

    })();
</script>

