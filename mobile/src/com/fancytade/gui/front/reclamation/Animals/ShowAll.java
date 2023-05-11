package com.fancytrade.gui.front.reclamation.Animals;

import com.codename1.components.*;
import com.codename1.ui.*;
import com.codename1.ui.layouts.*;
import com.fancytrade.entities.Reclamations;
import com.fancytrade.gui.front.reclamation.AnimalsCategory.Manage;
import com.fancytrade.services.ReclamationsService;
import java.util.*;

public class ShowAll extends Form {

    static Reclamations currentAnimal;

    Form previous; 
    
    public static Reclamations currentAnimals = null;
    Button addBtn;

    TextField searchTF;
    ArrayList<Component> componentModels;
    

    public ShowAll(Form previous) {
        super("Animals", new BoxLayout(BoxLayout.Y_AXIS));
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
        

        ArrayList<Reclamations> listAnimals = ReclamationsService.getInstance().getAll();
        componentModels = new ArrayList<>();
        
        searchTF = new TextField("", "Chercher Animals par Libelle");
        searchTF.addDataChangedListener((d, t) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            for (Reclamations Animals : listAnimals) {
                if (Animals.getMessage().toLowerCase().startsWith(searchTF.getText().toLowerCase())) {
                    Component model = makeAnimalsModel(Animals);
                    this.add(model);
                    componentModels.add(model);
                }
            }
            this.revalidate();
        });
        this.add(searchTF);
        
        
        if (listAnimals.size() > 0) {
            for (Reclamations Animals : listAnimals) {
                Component model = makeAnimalsModel(Animals);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }
    private void addActions() {
        addBtn.addActionListener(action -> {
            currentAnimal = null;
            new Manage(this).show();
        });
        
    }
    Label AnimalsCategoryLabel   , NomAnimalLabel   , GenreAnimalLabel   , EstSteriliseLabel , EstVaccineLabel ;
    

    private Container makeModelWithoutButtons(Reclamations Animals) {
        Container AnimalsModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        AnimalsModel.setUIID("containerRounded");
        
        
        AnimalsCategoryLabel = new Label("ReclamationsCategory : " + Animals.getReclamationsCategory());
        AnimalsCategoryLabel.setUIID("labelDefault");
        
        NomAnimalLabel = new Label(" message : " + Animals.getMessage());
        NomAnimalLabel.setUIID("labelDefault");
        
        GenreAnimalLabel = new Label("status : " + Animals.getStatus());
        GenreAnimalLabel.setUIID("labelDefault");
       
        
        
       
        

        AnimalsModel.addAll(
    AnimalsCategoryLabel, 
    NomAnimalLabel, 
    GenreAnimalLabel
);
        return AnimalsModel;
    }
    
    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makeAnimalsModel(Reclamations Animals) {

        Container AnimalsModel = makeModelWithoutButtons(Animals);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");
        
        editBtn = new Button("Modifier");
        editBtn.setUIID("buttonWhiteCenter");
        editBtn.addActionListener(action -> {
            currentAnimal = Animals;
            new Manage(this).show();
        });

        deleteBtn = new Button("Supprimer");
        deleteBtn.setUIID("buttonWhiteCenter");
        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce Animals ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = ReclamationsService.getInstance().delete(Animals.getId());

                if (responseCode == 200) {
                    currentAnimal = null;
                    dlg.dispose();
                    AnimalsModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du Animals. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.EAST, deleteBtn);
        
        
        AnimalsModel.add(btnsContainer);

        return AnimalsModel;
    }
    
}