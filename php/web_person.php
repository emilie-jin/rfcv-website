<?php
	session_start();
	include_once('includes/class_DAO_Bibilotheque.php');
	include_once('includes/bibliFonc.php');
	$DAO = new BibliothequeDAO();

//verifier si le utilisateur qui connecte, il est administrateur ou pas, si son profil est "A" ou "B", il est admin.
		if($_SESSION['ProfilPersonne']=="A" || $_SESSION['ProfilPersonne']=="B"){
			$user = array();
			$user = $DAO->getSesInfo($_SESSION['codePersonne']);
				//L'affichage mes informations
				echo'
				<div class="mes-info">
					<img src="images/modify_myinfos.png" alt="My infomations" width="40" height="40"/>
					<h3 id="title-mes-info"></h3>
					<table>
						<tr><td width="25%" class="nom_person">'.$user['Nom'].'</td><td class="prenom_person" text-align="left" >'.$user['Prenom'].'</td></tr>
						<tr><td></td><td class="partenaire_person">'.$user['Partenaire'].'</td></tr>
						<tr><td width="25%" id="tel-mes-info">Tel:</td><td class="tel_person">'.$user['Tel'].'</td></tr>
						<tr><td width="25%" id="fax-mes-info">Fax:</td><td class="fax_person">'.$user['Fax'].'</td></tr>
						<tr><td width="25%" id="mail-mes-info">Mail:</td><td class="mail_person">'.$user['mail'].'</td></tr>
						<tr><td></td><td><a id="Modifiez-mes-info" style="cursor:hand"></a></td></tr>
					</table>
				</div>';
				//Formulaire de modification mes informations
				echo'<div class="modifier_mesInfos">
						<form>
							<fieldset>
								<legend><img src="images/modify_myinfos.png" alt="New user" width="40" height="40"/><span id="ModifiezMesInfo-title"></span></legend>
								<table>
									<tr>
										<td>
											<label for="user_nom" id="ModifiezMesInfo-nom"></label>
										</td>
										<td>
											<input type="hidden" name="user_code" value="'.$_SESSION['codePersonne'].'" id="user_code"/>
											<input type="text" name="user_nom" id="user_nom" value="'.$user['Nom'].'"/>
										</td>
										<td>
											<span id="user_nom_tip"></span>
										</td>
										<td>
											<label for="user_prenom" id="ModifiezMesInfo-prenom"></label>
										</td>
										<td>
											<input type="text" name="user_prenom" id="user_prenom" value="'.$user['Prenom'].'"/>
										</td>
										<td>
											<span id="user_prenom_tip"></span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="password1" id="ModifiezMesInfo-password"></label>
										</td>
										<td>
											<input type="password" name="password1" id="password1"/>
										</td>
										<td>
											<span id="password1_tip"></span>
										</td>
										<td>
											<label for="password2" id="ModifiezMesInfo-repass"></label>
										</td>
										<td>
											<input type="password" name="password2" id="password2"/>
										</td>
										<td>
											<span id="password2_tip"></span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="user_tel" id="ModifiezMesInfo-tel"></label>
										</td>
										<td>
											<input type="text" name="user_tel" id="user_tel" value="'.$user['Tel'].'"/>
										</td>
										<td>
											<span id="user_tel_tip"></span>
										</td>
										<td>
											<label for="user_fax" id="ModifiezMesInfo-fax"></label>
										</td>
										<td>
											<input type="text" name="user_fax" id="user_fax" value="'.$user['Fax'].'"/>
										</td>
										<td>
											<span id="user_fax_tip"></span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="user_mail" id="ModifiezMesInfo-mail"></label>
										</td>
										<td>
											<input type="text" name="user_mail" id="user_mail" value="'.$user['mail'].'"/>
										</td>
										<td>
											<span id="user_mail_tip"></span>
										</td>
										<td colspan=2>
										</td>
									</tr>
									<tr>
										<td colspan=3></td>
										<td align="right">
											<a class="modifier_user_button" style="cursor:hand" id="ModifiezMesInfo-button"></a>
										</td>
									</tr>
								</table>
							</fieldset>
						</form>
					</div>';
				//Menu gestion des utilisateur
				echo'<div class="gestion-users">
						<img src="images/gestion_peson.png" alt="Gestion users" width="40" height="40"/>
						<h3 id="title-gestion-users"></h3>
						<ul id="ul-gestion-users"><li><input type="hidden" name="user_code_admin" value="'.$_SESSION['codePersonne'].'" id="user_code_admin" /><a id="list_des_utilisateur"></a></li><li><a id="new_user_create"></a></li></ul><input id="rechercher_user" type="text"/>
					</div>';
				//List des utilisateurs
				echo '
					<div class="list-users">
					<img src="images/list_person.png" alt="List users" width="40" height="40"/>
					<div><h3 id="title_list_user"></h3></div>
					<div class="table_info">
					<table class="table_info_contents">
					<tr><table id="listUser_header" width="100%"><th id="ListUser-nom" width="12%"></th><th id="ListUser-prenom" width="12%"></th><th id="ListUser-partenaire" width="12%" ></th><th id="ListUser-fonction" width="12%"></th><th id="ListUser-tel" width="12%"></th><th id="ListUser-fax" width="12%"></th><th id="ListUser-mail" width="12%"></th><th id="ListUser-dateFin" width="12%"></th><th> </th></tr></table>
					<tr><table id="contents_listUser" width="100%"></table></tr>
					</table>
					</div>
					</div>
					 ';
				//Resultat des recherchers 
				echo '
					<div class="resl-list-users">
					<img src="images/list_person.png" alt="List users" width="40" height="40"/>
					<div><h3 id="title_list_user_res"></h3></div>
					<div class="table_info">
					<table id="table_info_contents">
					<tr ><table id="listUser_header"><th id="ResUser-nom" width="13%"></th><th id="ResUser-prenom"  width="13%"></th><th id="ResUser-partenaire"  width="13%"></th><th id="ResUser-fonction" width="13%"></th><th id="ResUser-tel" width="13%"></th><th id="ResUser-fax" width="13%"></th><th id="ResUser-mail" width="13%"></th><th id="ResUser-dateFin" width="13%"></th><th>Détail</th></tr></table>
					<tr><table id="resl_contents_listUser"></table></tr>
					</table>
					</div>
					</div>
					 ';
				//Formulaire pour créer un nouveau utilisateur
				echo'
					<div class="new-user">
						<form>
							<fieldset>
								<legend><img src="images/new_user.png" alt="New user" width="40" height="40"/><span id="NewUser-title"></span></legend>
								<table>
								<tr>
									<td>
										<label for="CodePersonne_new" id="NewUser-codepersonne"></label>
									</td>
									<td>
										<input type="text" name="CodePersonne_new" id="CodePersonne_new"/>
									</td>
									<td>
										<span id="CodePersonne_new_tip"></span>
									</td>
									<td>
										<label for="Nom_new" id="NewUser-nom"></label>
									</td>
									<td>
										<input type="text" name="Nom_new" id="Nom_new"/>
									</td>
									<td>
										<span id="Nom_new_tip"></span>
									</td>
								</tr>
								<tr>
									<td>
										<label for="Prenom_new" id="NewUser-prenom"></label>
									</td>
									<td>
										<input type="text" name="Prenom_new" id="Prenom_new"/>
									</td>
									<td>
										<span id="Prenom_new_tip"></span>
									</td>
									<td>
										<label for="Function_new" id="NewUser-fonction"></label>
									</td>
									<td>
										<input type="text" name="Function_new" id="Function_new"/>
									</td>
									<td>
										<span id="Function_new_tip"></span>
									</td>
								</tr>
								<tr>
									<td>
										<label for="Profile_user_new" id="NewUser-profil"></label>
									</td>
									<td>
										<input type="text" name="Profile_user_new" id="Profile_user_new"/>
									</td>
									<td>
										<span id="Profile_user_new_tip"></span>
									</td>';
									
									if($_SESSION['ProfilPersonne']=="A"){
										
										echo '
										<td>
											<label for="Partenaire_new" id="NewUser-partenaire">Partenaire</label>
										</td>
										<td>
											<select name="Partenaire_new" id="Partenaire_new">';
										
										connexion_bbd();
										mysql_query('SET NAMES UTF8');
										$listePartenaire_select=$DAO->ListePartenaire();
										deconnexion_bbd();
										for($j=0;$j<count($listePartenaire_select);$j=$j+1){
											echo '<option value="'.$listePartenaire_select[$j]['code'].'">'.$listePartenaire_select[$j]['name'].'</option>';
										}
										echo'</select>
										</td>
										<td>
											<span id="Partenaire_new_tip"></span>
										</td>';
									}else{
										echo '<td>
												<label for="Partenaire_new" id="NewUser-partenaire-B">Partenaire</label>
											</td>
											<td>';
										connexion_bbd();
										mysql_query('SET NAMES UTF8');
										$partenaire_select=$DAO->Partenaire($_SESSION['CodePartenairePersonne']);
										deconnexion_bbd();
										echo '<select name="Partenaire_new" id="Partenaire_new"><option value="'.$_SESSION['CodePartenairePersonne'].'">'.$partenaire_select.'</option></select>';
										echo '</td>
										<td>
											<span id="Partenaire_new_tip"></span>
										</td>';
									}
						echo'
								</tr>
								<tr>
									<td>
										<label for="Dom_Compet_new" id="NewUser-dom"></label>
									</td>
									<td>
										<input type="text" name="Dom_Compet_new" id="Dom_Compet_new"/>
									</td>
									<td>
										<span id="Dom_Compet_new_tip"></span>
									</td>
									<td>
										<label for="Tel_new" id="NewUser-tel"></label>
									</td>
									<td>
										<input type="text" name="Tel_new" id="Tel_new"/>
									</td>
									<td>
										<span id="Tel_new_tip"></span>
									</td>
								</tr>
								<tr>
									<td>
										<label for="Fax_new" id="NewUser-fax"></label>
									</td>
									<td>
										<input type="text" name="Fax_new" id="Fax_new"/>
									</td>
									<td>
										<span id="Fax_new_tip"></span>
									</td>
									<td>
										<label for="Mail_new" id="NewUser-mail"></label>
									</td>
									<td>
										<input type="text" name="Mail_new" id="Mail_new"/>
									</td>
									<td>
										<span id="Mail_new_tip"></span>
									</td>
								</tr>
								<tr>
									<td>
										<label for="DateFinValide_new" id="NewUser-dateFin"></label>
									</td>
									<td>
										<input type="text" name="DateFinValide_new" id="DateFinValide_new"/>
									</td>
									<td>
										<span id="DateFinValide_new_tip"></span>
									</td>
									<td></td>
								</tr>
								<tr>
									<td colspan=3></td>
									<td>
										<a class="new_user_button" style="cursor:hand" id="NewUser-button"></a>
									</td>
								</tr>
								</table>
							</fieldset>
						</form>
						</div>
					';
					//L'affichage ses informations
					echo '
						<div class="ses-info">
						<img src="images/info_person.png" alt="INFORMATIONS" width="40" height="40"/>
						<h3 id="title-ses-info"></h3>
						<table id="ses_info_table">
						</table>
						</div>
					';
					//Formulaire du changement ses information
					echo'<div class="modifier_ses_info"></div>';
			
		}
		else{
			$user2 = array();
			$user2 = $DAO->getSesInfo($_SESSION['codePersonne']);
				//afficher mes informations
				echo'
				<div class="mes-info">
					<img src="images/info_person.png" alt="My infomations" width="40" height="40"/>
					<h3 id="title-mes-info">Votre informations</h3>
					<table>
						<tr><td colspan=2 class="nom_person">'.$user2['Nom'].'</td><td colspan=2 class="prenom_person">'.$user2['Prenom'].'</td><td id="partenaire-mes-info">vient de</td><td class="partenaire_person">'.$user2['Partenaire'].'</td></tr>
						<tr><td id="tel-mes-info">Tel:</td><td class="tel_person">'.$user2['Tel'].'</td><td id="fax-mes-info">Fax:</td><td class="fax_person">'.$user2['Fax'].'</td><td id="mail-mes-info">Mail:</td><td class="mail_person">'.$user2['mail'].'</td></tr>
						<tr><td colspan=5> </td><td><a  style="cursor:hand" id="Modifiez-mes-info">Modifiez</a></td></tr>
					</table>
				</div>';
				//afficher le formulaire pour modifier mes informations
				echo'<div class="modifier_mesInfos">
						<form>
							<fieldset>
								<legend><img src="images/modify_myinfos.png" alt="New user" width="40" height="40"/>Modifiez</legend>
								<table>
									<tr>
										<td>
											<label for="user_nom">Nom</label>
										</td>
										<td>
											<input type="hidden" name="user_code" value="'.$_SESSION['codePersonne'].'" id="user_code" />
											<input type="text" name="user_nom" id="user_nom" value="'.$user2['Nom'].'"/>
										</td>
										<td>
											<span id="user_nom_tip">1</span>
										</td>
										<td>
											<label for="user_prenom">Prenom</label>
										</td>
										<td>
											<input type="text" name="user_prenom" id="user_prenom" value="'.$user2['Prenom'].'"/>
										</td>
										<td>
											<span id="user_prenom_tip">2</span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="password1">Inserez votre nouveau mot de Passe</label>
										</td>
										<td>
											<input type="password" name="password1" id="password1"/>
										</td>
										<td>
											<span id="password1_tip">3</span>
										</td>
										<td>
											<label for="password2">Inserez votre nouveau mot de Passe à nouveau</label>
										</td>
										<td>
											<input type="password" name="password2" id="password2"/>
										</td>
										<td>
											<span id="password2_tip">4</span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="user_tel">Tel</label>
										</td>
										<td>
											<input type="text" name="user_tel" id="user_tel" value="'.$user2['Tel'].'"/>
										</td>
										<td>
											<span id="user_tel_tip">5</span>
										</td>
										<td>
											<label for="user_fax">Fax</label>
										</td>
										<td>
											<input type="text" name="user_fax" id="user_fax" value="'.$user2['Fax'].'"/>
										</td>
										<td>
											<span id="user_fax_tip">6</span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="user_mail">Mail</label>
										</td>
										<td>
											<input type="text" name="user_mail" id="user_mail" value="'.$user2['mail'].'"/>
										</td>
										<td>
											<span id="user_mail_tip">7</span>
										</td>
										<td colspan=2>
										</td>
									</tr>
									<tr>
										<td colspan=3></td>
										<td>
											<a class="modifier_user_button" style="cursor:hand" >Enregisterr</a>
										</td>
									</tr>
								</table>
							</fieldset>
						</form>
					</div>';
			
		}

?>