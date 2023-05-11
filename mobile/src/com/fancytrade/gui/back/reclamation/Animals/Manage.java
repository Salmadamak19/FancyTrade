package com.fancytrade.gui.back.reclamation.Animals;


import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;

import com.fancytrade.entities.ReclamationCategory;
import com.fancytrade.entities.Reclamations;
import com.fancytrade.services.AnimalsCategoryService;
import com.fancytrade.services.ReclamationsService;
import com.fancytrade.utils.AlertUtils;
import java.util.*;

public class Manage extends Form {



    Reclamations currentAnimals;

    TextField NomAnimalTF;TextField GenreAnimalTF; TextField EstSteriliseTF;TextField EstVaccineTF;
    Label NomAnimalLabel;Label GenreAnimalLabel;Label EstSteriliseLabel; Label EstVaccineLabel;


    ArrayList<ReclamationCategory> listAnimalsCategory;
    PickerComponent AnimalsCategoryPC;
    ReclamationCategory selectedAnimalsCategory = null;


    Button manageButton;

    Form previous;

    public Manage(Form previous) {
        super(ShowAll.currentAnimals == null ?  "Ajouter" :  "Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentAnimals = ShowAll.currentAnimals;

        addGUIs();
        addActions();

        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        String[] AnimalsCategoryStrings;
        int AnimalsCategoryIndex;
        AnimalsCategoryPC = PickerComponent.createStrings("").label("ReclamationCategory");
        listAnimalsCategory = AnimalsCategoryService.getInstance().getAll();
        AnimalsCategoryStrings = new String[listAnimalsCategory.size()];
        AnimalsCategoryIndex = 0;
        for (ReclamationCategory AnimalsCategory : listAnimalsCategory) {
            AnimalsCategoryStrings[AnimalsCategoryIndex] = (String) AnimalsCategory.getNom();
            AnimalsCategoryIndex++;
        }
        if(listAnimalsCategory.size() > 0) {
            AnimalsCategoryPC.getPicker().setStrings(AnimalsCategoryStrings);
            AnimalsCategoryPC.getPicker().addActionListener(l -> selectedAnimalsCategory = listAnimalsCategory.get(AnimalsCategoryPC.getPicker().getSelectedStringIndex()));
        } else {
            AnimalsCategoryPC.getPicker().setStrings("");
        }






        NomAnimalLabel = new Label("message : ");
        NomAnimalLabel.setUIID("labelDefault");
        NomAnimalTF = new TextField();
        NomAnimalTF.setHint("Tapez le message");



        GenreAnimalLabel = new Label("status : ");
        GenreAnimalLabel.setUIID("labelDefault");
        GenreAnimalTF = new TextField();
        GenreAnimalTF.setHint("Tapez status");



       








        if (currentAnimals == null) {


            manageButton = new Button("Ajouter");
        } else {

            NomAnimalTF.setText(currentAnimals.getMessage());
            GenreAnimalTF.setText(String.valueOf(currentAnimals.getStatus()));

            /*
            AnimalsCategoryPC.getPicker().setSelectedString((String) currentAnimals.getAnimalsCategory().toString());

//            AnimalsCategoryPC.getPicker().setSelectedString((String) currentAnimals.getAnimalsCategory().getEspece());
             //AnimalsCategoryPC.getPicker().setSelectedString((String) currentAnimals.getAnimalsCategory().getRace());
            selectedAnimalsCategory = currentAnimals.getAnimalsCategory();

            **/


            manageButton = new Button("Modifier");
        }
        manageButton.setUIID("buttonWhiteCenter");

        Container container = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        container.setUIID("containerRounded");

        container.addAll(


          NomAnimalLabel, NomAnimalTF,
            GenreAnimalLabel, GenreAnimalTF,
         
            AnimalsCategoryPC,
            manageButton
        );


        this.addAll(container);
    }

    private void addActions() {

        if (currentAnimals == null) {
            manageButton.addActionListener(action -> {
                if (controleDeSaisie()) {
                    int responseCode = ReclamationsService.getInstance().add(
                            new Reclamations(


                                   selectedAnimalsCategory,
                                    1,
                                    Integer.parseInt(GenreAnimalTF.getText()),
                                    NomAnimalTF.getText()
                                  
                            )
                    );
                    if (responseCode == 200) {
                        AlertUtils.makeNotification("reclamation ajouté avec succes");
                        showBackAndRefresh();
                    } else {
                        Dialog.show("Erreur", "Erreur d'ajout de reclamation. Code d'erreur : " + responseCode, new Command("Ok"));
                    }
                }
            });
        } else {
            manageButton.addActionListener(action -> {
                if (controleDeSaisie()) {
                    int responseCode = ReclamationsService.getInstance().edit(
                            new Reclamations(
                                    currentAnimals.getId(),


                                   selectedAnimalsCategory,
                                    1,
                                    Integer.parseInt(GenreAnimalTF.getText()),
                                    NomAnimalTF.getText()

                            )
                    );
                    if (responseCode == 200) {
                        AlertUtils.makeNotification("Reclamation modifié avec succes");
                        showBackAndRefresh();
                    } else {
                        Dialog.show("Erreur", "Erreur de modification de Reclamation. Code d'erreur : " + responseCode, new Command("Ok"));
                    }
                }
            });
        }
    }

    private void showBackAndRefresh(){
        ((ShowAll) previous).refresh();
        previous.showBack();
    }

    private boolean controleDeSaisie() {






       if (NomAnimalTF.getText().equals("")) {
            Dialog.show("Avertissement", "NomAnimal vide", new Command("Ok"));
            return false;
        }




        if (GenreAnimalTF.getText().equals("")) {
            Dialog.show("Avertissement", "GenreAnimal vide", new Command("Ok"));
            return false;
        }








        if (selectedAnimalsCategory == null) {
            Dialog.show("Avertissement", "Veuillez choisir un ReclmationCategory", new Command("Ok"));
            return false;
        }




        return true;
    }
}