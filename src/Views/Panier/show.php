<?php

use Panier\Models\Formateur;

ob_start();
?>

<section class="dashboard" style="flex:initial;">
<div class="topDashBoard">
        <h1><i class="fas fa-list-alt"></i> Panier :</h1>
    </div>
<form action="/dashboard/<?php echo escape($todo->getPersone()); ?>/modif" method="post">
    <div class="viewList">
        <div class="top">
            <div class="enleveTodolist">
                <div>
                    
                        <p class="nameList">
                            Nom : <input type="text" name="nom" value="<?php echo escape($todo->getNom()); ?>">
                        </p>
                        <p class="nameList">
                            Prenom : <input type="text" name="prenom" value="<?php echo escape($todo->getPrenom()); ?>">
                        </p>
                        <p class="nameList">
                            nation : <select name="nat" id="nation">
                                <?php
                                foreach ($nat as $nats) {
                                ?>
                                    <option <?php if ($todo->getNat() == $nats->getNat()) {
                                                echo "selected='selected'";
                                            } ?> value='<?php echo $nats->getIdNat(); ?>'> <?php echo $nats->getNat(); ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                        <p class="nameList">
                            formation : <select name="form" id="form">
                                <?php
                                foreach ($formation as $formations) {
                                ?>
                                    <option <?php if ($todo->getForm() == $formations->getForm()) {
                                                echo "selected='selected'";
                                            } ?> value='<?php echo $formations->getIdForm(); ?>'><?php echo $formations->getForm(); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </p>
                </div>
            </div>
            
            <div class="afficheInput hiddenEdit">
                <p id="btnDeleteList" title="Suprimer Article"><i class="fas fa-trash"></i></p>
            </div>
        </div>
        
        <div class="separateur"></div>
        <div class="tache">
            <p style="text-align: center;">
                <span class="error"><?php echo error("name"); ?></span>
            </p>
                <?php
                foreach ($formateur as $formateurs) {
                ?>
                    <p class="margin">
                        <?php
                        echo "<input name='formateurs[]' value='" . $formateurs->getIdFormateur() . "' class='formateurs' type='checkbox' ";
                        foreach ($todo->allForm() as $taches) {
                            if ($taches->getNOMFORM() == $formateurs->getNomFormateur()) {
                                echo 'checked ';
                            }
                        }
                        ?> >

                        <?=
                        $formateurs->getNomFormateur()." ".
                        $formateurs->getPrenomFormateur();
                        ?>
                        dans la salle
                        <?=
                        $formateurs->getLibelle()
                        ?> début :
                        <input class='datedeb' type='date' name='datedeb[]' value="<?php
                        foreach ($todo->allForm() as $taches) {
                            if ($taches->getNOMFORM() == $formateurs->getNomFormateur()) {
                                echo $taches->getDateDebUS();
                            }
                        }
                        ?>">
                        fin :
                        <input class='datefin' type='date' name='datefin[]' value="<?php
                        foreach ($todo->allForm() as $taches) {
                            if ($taches->getNOMFORM() == $formateurs->getNomFormateur()) {
                                echo $taches->getDateFinUS();
                            }
                        }
                        ?>">
                        <input class='hidde' type='hidden' value='<?php foreach ($formateur2->getAllFormateur2($formateurs->getIdFormateur()) as $formateurs2) { ?><?= $formateurs2->getIdDuFormateur() . "_" ?><?php } ?>'>
                    </p><br>
                <?php
                }
                ?>
                <input type="submit" value="modifier">
            </div>
        </div>
    </form>

</section>
<script src="/js/app.js"></script>
<?php

$content = ob_get_clean();
require VIEWS . 'layout.php';
