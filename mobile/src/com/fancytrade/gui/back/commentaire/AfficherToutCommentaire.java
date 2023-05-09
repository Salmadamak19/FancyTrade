package com.fancytrade.gui.back.commentaire;


import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.services.CommentaireService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutCommentaire extends Form {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Commentaire currentCommentaire = null;


    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public AfficherToutCommentaire(Form previous) {
        super(new BoxLayout(BoxLayout.Y_AXIS));
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


        ArrayList<Commentaire> listCommentaires = CommentaireService.getInstance().getAll();

        componentModels = new ArrayList<>();

        sortPicker = PickerComponent.createStrings("User", "Post", "Image", "Description", "Date", "Analyse", "DatecTs").label("Trier par");
        sortPicker.getPicker().setSelectedString("");
        sortPicker.getPicker().addActionListener((l) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            Statics.compareVar = sortPicker.getPicker().getSelectedString();
            Collections.sort(listCommentaires);
            for (Commentaire commentaire : listCommentaires) {
                Component model = makeCommentaireModel(commentaire);
                this.add(model);
                componentModels.add(model);
            }
            this.revalidate();
        });
        this.add(sortPicker);

        if (listCommentaires.size() > 0) {
            for (Commentaire commentaire : listCommentaires) {
                Component model = makeCommentaireModel(commentaire);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {

    }

    Label userLabel, postLabel, imageLabel, descriptionLabel, dateLabel, analyseLabel, datecTsLabel;

    ImageViewer imageIV;


    private Container makeModelWithoutButtons(Commentaire commentaire) {
        Container commentaireModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        commentaireModel.setUIID("containerRounded");


        userLabel = new Label("User : " + commentaire.getUser());
        userLabel.setUIID("labelDefault");

        postLabel = new Label("Post : " + commentaire.getPost());
        postLabel.setUIID("labelDefault");

        imageLabel = new Label("Image : " + commentaire.getImage());
        imageLabel.setUIID("labelDefault");

        descriptionLabel = new Label("Description : " + commentaire.getDescription());
        descriptionLabel.setUIID("labelDefault");

        dateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDate()));
        dateLabel.setUIID("labelDefault");

        analyseLabel = new Label("Analyse : " + commentaire.getAnalyse());
        analyseLabel.setUIID("labelDefault");

        datecTsLabel = new Label("DatecTs : " + new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDatecTs()));
        datecTsLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + commentaire.getUser().getEmail());
        userLabel.setUIID("labelDefault");

        postLabel = new Label("Post : " + commentaire.getPost().getSujet());
        postLabel.setUIID("labelDefault");

        if (commentaire.getImage() != null) {
            String url = Statics.COMMENTAIRE_IMAGE_URL + commentaire.getImage();
            Image image = URLImage.createToStorage(
                    EncodedImage.createFromImage(theme.getImage("user-picture.jpg").fill(1100, 500), false),
                    url,
                    url,
                    URLImage.RESIZE_SCALE
            );
            imageIV = new ImageViewer(image);
        } else {
            imageIV = new ImageViewer(theme.getImage("user-picture.jpg").fill(1100, 500));
        }
        imageIV.setFocusable(false);

        commentaireModel.addAll(
                imageIV,
                userLabel, postLabel, descriptionLabel, dateLabel, analyseLabel, datecTsLabel
        );

        return commentaireModel;
    }

    private Component makeCommentaireModel(Commentaire commentaire) {


        return makeModelWithoutButtons(commentaire);
    }

}