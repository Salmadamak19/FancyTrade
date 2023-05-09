package com.fancytrade.gui.front.comment;


import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.fancytrade.MainApp;
import com.fancytrade.entities.Comment;
import com.fancytrade.entities.Publication;
import com.fancytrade.gui.front.publication.AfficherToutPublication;
import com.fancytrade.services.CommentService;
import com.fancytrade.services.PublicationService;
import com.fancytrade.utils.AlertUtils;

import java.util.ArrayList;

public class AjouterComment extends Form {


    TextField contentTF;
    Label contentLabel;
    PickerComponent dateTF;

    ArrayList<Publication> listPublications;
    PickerComponent publicationPC;
    Publication selectedPublication = null;


    Button manageButton;

    Form previous;

    public AjouterComment(Form previous, Publication publication) {
        super("Ajouter", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;
        this.selectedPublication = publication;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        String[] publicationStrings;
        int publicationIndex;
        publicationPC = PickerComponent.createStrings("").label("Publication");
        listPublications = PublicationService.getInstance().getAll();
        publicationStrings = new String[listPublications.size()];
        publicationIndex = 0;
        for (Publication publication : listPublications) {
            publicationStrings[publicationIndex] = publication.getContent();
            publicationIndex++;
        }
        if (listPublications.size() > 0) {
            publicationPC.getPicker().setStrings(publicationStrings);
            publicationPC.getPicker().addActionListener(l -> selectedPublication = listPublications.get(publicationPC.getPicker().getSelectedStringIndex()));
        } else {
            publicationPC.getPicker().setStrings("");
        }

        if (selectedPublication != null) publicationPC.getPicker().setSelectedString(selectedPublication.getContent());

        contentLabel = new Label("Content : ");
        contentLabel.setUIID("labelDefault");
        contentTF = new TextField();
        contentTF.setHint("Tapez le content");

        dateTF = PickerComponent.createDate(null).label("Date");


        manageButton = new Button("Ajouter");


        Container container = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        container.setUIID("containerRounded");

        container.addAll(


                contentLabel, contentTF,
                dateTF,
                publicationPC,
                manageButton
        );

        this.addAll(container);
    }

    private void addActions() {

        manageButton.addActionListener(action -> {
            if (controleDeSaisie()) {
                int responseCode = CommentService.getInstance().add(
                        new Comment(
                                selectedPublication,
                                MainApp.getSession(),
                                contentTF.getText(),
                                dateTF.getPicker().getDate()
                        )
                );
                if (responseCode == 200) {
                    AlertUtils.makeNotification("Comment ajouté avec succes");
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur d'ajout de comment. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        try {
            ((AfficherToutComment) previous).refresh();
        } catch (ClassCastException e) {
            ((AfficherToutPublication) previous).refresh();
        }
        previous.showBack();
    }

    private boolean controleDeSaisie() {


        if (contentTF.getText().equals("")) {
            Dialog.show("Avertissement", "Content vide", new Command("Ok"));
            return false;
        }


        if (dateTF.getPicker().getDate() == null) {
            Dialog.show("Avertissement", "Veuillez saisir la date", new Command("Ok"));
            return false;
        }


        if (selectedPublication == null) {
            Dialog.show("Avertissement", "Veuillez choisir un publication", new Command("Ok"));
            return false;
        }

        return true;
    }
}