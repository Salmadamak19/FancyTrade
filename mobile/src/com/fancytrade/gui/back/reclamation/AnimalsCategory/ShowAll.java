package com.fancytrade.gui.back.reclamation.AnimalsCategory;

import com.codename1.components.*;
import com.codename1.ui.*;
import com.codename1.ui.layouts.*;

import com.fancytrade.entities.ReclamationCategory;
import com.fancytrade.services.AnimalsCategoryService;
import com.fancytrade.utils.Statics;
import java.util.*;

public class ShowAll extends Form {

    Form previous; 
    
    public static ReclamationCategory currentAnimalsCategory = null;
    Button addBtn;

    
    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public ShowAll(Form previous) {
        super("ReclamationsCategory", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        addGUIs();
        addActions();

        super.getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    public void refresh() {
        this.removeAll();
        addGUIs();
        addActions();
        this.refreshTheme();
    }

    private void addGUIs() {
        addBtn = new Button("Ajouter");
        addBtn.setUIID("buttonWhiteCenter");
        this.add(addBtn);
        

        ArrayList<ReclamationCategory> listAnimalsCategory = AnimalsCategoryService.getInstance().getAll();
        
        componentModels = new ArrayList<>();
        
        sortPicker = PickerComponent.createStrings("nom").label("Trier par");
        sortPicker.getPicker().setSelectedString("");
        sortPicker.getPicker().addActionListener((l) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            Statics.compareVar = sortPicker.getPicker().getSelectedString();
            //Collections.sort(listAnimalsCategory);
            for (ReclamationCategory AnimalsCategory : listAnimalsCategory) {
                Component model = makeAnimalsCategoryModel(AnimalsCategory);
                this.add(model);
                componentModels.add(model);
            }
            this.revalidate();
        });
        this.add(sortPicker);
        
        if (listAnimalsCategory.size() > 0) {
            for (ReclamationCategory AnimalsCategory : listAnimalsCategory) {
                Component model = makeAnimalsCategoryModel(AnimalsCategory);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }
    private void addActions() {
        addBtn.addActionListener(action -> {
            currentAnimalsCategory = null;
            new Manage(this).show();
        });
        
    }
    Label EspeceLabel   , RaceLabel  ;
    

    private Container makeModelWithoutButtons(ReclamationCategory AnimalsCategory) {
        Container AnimalsCategoryModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        AnimalsCategoryModel.setUIID("containerRounded");
        
        
        EspeceLabel = new Label("Espece : " + AnimalsCategory.getNom());
        EspeceLabel.setUIID("nom");
        
       

        AnimalsCategoryModel.addAll(
                
                EspeceLabel
        );

        return AnimalsCategoryModel;
    }
    
    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makeAnimalsCategoryModel(ReclamationCategory AnimalsCategory) {

        Container AnimalsCategoryModel = makeModelWithoutButtons(AnimalsCategory);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");
        
        editBtn = new Button("Modifier");
        editBtn.setUIID("buttonWhiteCenter");
        editBtn.addActionListener(action -> {
            currentAnimalsCategory = AnimalsCategory;
            new Manage(this).show();
        });

        deleteBtn = new Button("Supprimer");
        deleteBtn.setUIID("buttonWhiteCenter");
        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce ReclamationsCategory ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = AnimalsCategoryService.getInstance().delete(AnimalsCategory.getId());

                if (responseCode == 200) {
                    currentAnimalsCategory = null;
                    dlg.dispose();
                    AnimalsCategoryModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du ReclamationsCategory. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.EAST, deleteBtn);
        
        
        AnimalsCategoryModel.add(btnsContainer);

        return AnimalsCategoryModel;
    }
    
}