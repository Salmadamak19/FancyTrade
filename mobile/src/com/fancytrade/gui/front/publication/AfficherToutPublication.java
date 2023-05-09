package com.fancytrade.gui.front.publication;


import com.codename1.components.ImageViewer;
import com.codename1.components.InteractionDialog;
import com.codename1.components.ShareButton;
import com.codename1.io.FileSystemStorage;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.ImageIO;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Comment;
import com.fancytrade.entities.Publication;
import com.fancytrade.gui.front.comment.AfficherToutComment;
import com.fancytrade.gui.front.comment.AjouterComment;
import com.fancytrade.gui.front.comment.ModifierComment;
import com.fancytrade.gui.uikit.SideMenuBaseForm;
import com.fancytrade.services.CommentService;
import com.fancytrade.services.PublicationService;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.io.OutputStream;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class AfficherToutPublication extends SideMenuBaseForm {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Publication currentPublication = null;
    Button addBtn;


    public AfficherToutPublication(Resources res) {
        super(new BoxLayout(BoxLayout.Y_AXIS));

        Toolbar tb = new Toolbar(true);
        tb.setUIID("CustomToolbar");
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Publication");
        getContentPane().setScrollVisible(false);
        super.addSideMenu(res);

        addGUIs();
        addActions();
    }

    public void refresh() {
        this.removeAll();
        addGUIs();
        addActions();
        this.refreshTheme();
    }

    private void addGUIs() {

        Container container = new Container();
        container.setPreferredH(250);
        this.add(container);

        addBtn = new Button("Ajouter");

        this.add(addBtn);

        ArrayList<Publication> listPublications = PublicationService.getInstance().getAll();


        if (listPublications.size() > 0) {
            for (Publication publication : listPublications) {
                Component model = makePublicationModel(publication);
                this.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }

    }

    private void addActions() {
        addBtn.addActionListener(action -> {
            currentPublication = null;
            new AjouterPublication(this).show();
        });

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

    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makePublicationModel(Publication publication) {

        Container publicationModel = makeModelWithoutButtons(publication);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");

        editBtn = new Button("Modifier");

        editBtn.addActionListener(action -> {
            currentPublication = publication;
            new ModifierPublication(this).show();
        });

        deleteBtn = new Button("Supprimer");

        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce publication ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = PublicationService.getInstance().delete(publication.getId());

                if (responseCode == 200) {
                    currentPublication = null;
                    dlg.dispose();
                    publicationModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du publication. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.CENTER, deleteBtn);
        btnsContainer.add(BorderLayout.EAST, buildShareButton(publication));

        publicationModel.add(btnsContainer);

        ArrayList<Comment> listComment = CommentService.getInstance().getAll();

        publicationModel.add(new Label("Comments : "));
        for (Comment comment : listComment) {
            if (comment.getPublication().getId() == comment.getId()) {
                publicationModel.add(makeCommentModel(comment));
            }
        }

        Button addCommentButton = new Button("Ajouter un commentaire");
        addCommentButton.addActionListener(action -> {
            AfficherToutComment.currentComment = null;
            new AjouterComment(this, publication).show();
        });
        publicationModel.add(addCommentButton);


        return publicationModel;
    }

    Label commentPublicationLabel, commentUserLabel, commentContentLabel, commentDateLabel;


    private Container makeModelWithoutButtons(Comment comment) {
        Container commentModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        commentModel.setUIID("containerRounded");


        commentPublicationLabel = new Label("Publication : " + comment.getPublication());
        commentPublicationLabel.setUIID("labelDefault");

        commentUserLabel = new Label("User : " + comment.getUser());
        commentUserLabel.setUIID("labelDefault");

        commentContentLabel = new Label("Content : " + comment.getContent());
        commentContentLabel.setUIID("labelDefault");

        commentDateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(comment.getDate()));
        commentDateLabel.setUIID("labelDefault");

        commentPublicationLabel = new Label("Publication : " + comment.getPublication().getContent());
        commentPublicationLabel.setUIID("labelDefault");

        commentUserLabel = new Label("User : " + comment.getUser().getEmail());
        commentUserLabel.setUIID("labelDefault");


        commentModel.addAll(
                commentPublicationLabel, commentUserLabel, commentContentLabel, commentDateLabel
        );

        return commentModel;
    }

    Button commentEditBtn, commentDeleteBtn;
    Container commentBtnsContainer;

    private Component makeCommentModel(Comment comment) {

        Container commentModel = makeModelWithoutButtons(comment);

        commentBtnsContainer = new Container(new BorderLayout());
        commentBtnsContainer.setUIID("containerButtons");

        commentEditBtn = new Button("Modifier");

        commentEditBtn.addActionListener(action -> {
            AfficherToutComment.currentComment = comment;
            new ModifierComment(this).show();
        });

        commentDeleteBtn = new Button("Supprimer");

        commentDeleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce comment ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = CommentService.getInstance().delete(comment.getId());

                if (responseCode == 200) {
                    AfficherToutComment.currentComment = null;
                    dlg.dispose();
                    commentModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du comment. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        commentBtnsContainer.add(BorderLayout.WEST, commentEditBtn);
        commentBtnsContainer.add(BorderLayout.EAST, commentDeleteBtn);


        commentModel.add(commentBtnsContainer);

        return commentModel;
    }

    private ShareButton buildShareButton(Publication publication) {
        ShareButton btnPartager = new ShareButton();
        btnPartager.setText("Partager");
        btnPartager.setTextPosition(LEFT);
        btnPartager.setTextToShare(publication.toString());

        Image image;
        if (publication.getImage() != null) {
            String url = Statics.PUBLICATION_IMAGE_URL + publication.getImage();
            image = URLImage.createToStorage(
                    EncodedImage.createFromImage(theme.getImage("user-picture.jpg").fill(1100, 500), false),
                    url,
                    url,
                    URLImage.RESIZE_SCALE
            );
        } else {
            image = theme.getImage("user-picture.jpg").fill(1100, 500);
        }
        String path = null;
        if (image != null) {
            path = FileSystemStorage.getInstance().getAppHomePath() + "myImage.png";
            try (OutputStream os = FileSystemStorage.getInstance().openOutputStream(path)) {
                ImageIO.getImageIO().save(image, os, ImageIO.FORMAT_PNG, 1.0f);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        btnPartager.setImageToShare(path, "image/png");

        return btnPartager;
    }
}