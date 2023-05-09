package com.fancytrade.gui.back.publication;


import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Publication;
import com.fancytrade.services.PublicationService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutPublication extends Form {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Publication currentPublication = null;


    public AfficherToutPublication(Form previous) {
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

    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    private void addGUIs() {


        ArrayList<Publication> listPublications = PublicationService.getInstance().getAll();
        componentModels = new ArrayList<>();

        sortPicker = PickerComponent.createStrings("User", "Content", "Date").label("Trier par");
        sortPicker.getPicker().setSelectedString("");
        sortPicker.getPicker().addActionListener((l) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            Statics.compareVar = sortPicker.getPicker().getSelectedString();
            Collections.sort(listPublications);
            for (Publication publication : listPublications) {
                Component model = makePublicationModel(publication);
                this.add(model);
                componentModels.add(model);
            }
            this.revalidate();
        });
        this.add(sortPicker);


        if (listPublications.size() > 0) {
            for (Publication publication : listPublications) {
                Component model = makePublicationModel(publication);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }

    }

    private void addActions() {
    }

    Label userLabel, contentLabel, dateLabel, imageLabel;

    ImageViewer imageIV;


    private Container makeModelWithoutButtons(Publication publication) {
        Container publicationModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        publicationModel.setUIID("containerRounded");


        userLabel = new Label("User : " + publication.getUser());
        userLabel.setUIID("labelDefault");

        contentLabel = new Label("Content : " + publication.getContent());
        contentLabel.setUIID("labelDefault");

        dateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(publication.getDate()));
        dateLabel.setUIID("labelDefault");

        imageLabel = new Label("Image : " + publication.getImage());
        imageLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + publication.getUser().getEmail());
        userLabel.setUIID("labelDefault");

        if (publication.getImage() != null) {
            String url = Statics.PUBLICATION_IMAGE_URL + publication.getImage();
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

        publicationModel.addAll(
                imageIV,
                userLabel, contentLabel, dateLabel
        );

        return publicationModel;
    }

    private Component makePublicationModel(Publication publication) {
        return makeModelWithoutButtons(publication);
    }

}