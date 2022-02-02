<?php 
								$categ = $this->Categorie_model->get_categorie()
							?>
							<table class="table table-bordered">
								<?php 
									foreach ($categ as $key => $r) {

									?>
										<tr>
											<td><?php echo $r['nom_c'] ?></td>
											<td align="center">
												<button onclick="modif_categorie('<?php echo $r['id_categorie'] ?>','<?php echo $r['nom_c'] ?>')" class="simple"><span class="glyphicon glyphicon-edit"></span> </button>
												<button onclick="supprimer_categorie('<?php echo $r['id_categorie'] ?>')" class="simple rouge"><span class="glyphicon glyphicon-trash"></span> </button>
											</td>
										</tr>
									<?php
									}
									?>
							</table>