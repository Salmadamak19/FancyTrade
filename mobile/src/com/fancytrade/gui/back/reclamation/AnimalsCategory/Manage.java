package com.fancytrade.gui.back.reclamation.AnimalsCategory;


import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;

import com.fancytrade.entities.ReclamationCategory;
import com.fancytrade.gui.back.reclamation.AnimalsCategory.ShowAll;
import com.fancytrade.services.AnimalsCategoryService;

public class Manage extends Form {

    

    ReclamationCategory currentAnimalsCategory;

    TextField EspeceTF;TextField RaceTF;
    Label EspeceLabel;Label RaceLabel;
    
    
    
    
    Button manageButton;

    Form previous;

    public Manage(Form previous) {
        super(ShowAll.currentAnimalsCategory == null ?  "Ajouter" :  "Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentAnimalsCategory = ShowAll.currentAnimalsCategory;

        addGUIs();
        addActions();

        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {
        

        
        
        EspeceLabel = new Label("nom : ");
        EspeceLabel.setUIID("nom");
        EspeceTF = new TextField();
        EspeceTF.setHint("Tapez l' nom");
        
        
        
        
        
        

        if (currentAnimalsCategory == null) {
            
            
            manageButton = new Button("Ajouter");
        } else {
            EspeceTF.setText(currentAnimalsCategory.getNom());
   
            
            
            

            manageButton = new Button("Modifier");
        }
        manageButton.setUIID("buttonWhiteCenter");

        Container container = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        container.setUIID("containerRounded");

        container.addAll(
            
            EspeceLabel, EspeceTF,
           
            
            manageButton
        );

        this.addAll(container);
    }

    private void addActions() {
        
        if (currentAnimalsCategory == null) {
            manageButton.addActionListener(action -> {
                if (controleDeSaisie()) {
                    int responseCode = AnimalsCategoryService.getInstance().add(
                            new ReclamationCategory(
                                    
                                    
                                    EspeceTF.getText()                                  
                            )
                    );
                    if (responseCode == 200) {
                         Dialog.show("Succés", "ReclamationCategory ajouté avec succes", new Command("Ok"));
                        showBackAndRefresh();
                    } else {
                        Dialog.show("Erreur", "Erreur d'ajout de ReclamationsCategory. Code d'erreur : " + responseCode, new Command("Ok"));
                    }
                }
            });
        } else {
            manageButton.addActionListener(action -> {
                if (controleDeSaisie()) {
                    int responseCode = AnimalsCategoryService.getInstance().edit(
                            new ReclamationCategory(
                                    currentAnimalsCategory.getId(),
                                    
                                    
                                    EspeceTF.getText()

                            )
                    );
                    if (responseCode == 200) {
                         Dialog.show("Succés", "ReclamtionsCategory modifié avec succes", new Command("Ok"));
                        showBackAndRefresh();
                    } else {
                        Dialog.show("Erreur", "Erreur de modification de ReclamationsCategory. Code d'erreur : " + responseCode, new Command("Ok"));
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

        
        
        if (EspeceTF.getText().equals("")) {
            Dialog.show("Avertissement", "Espece vide", new Command("Ok"));
            return false;
        }
        
        
        
       
        
        

        

        
             
        return true;
    }
}