package com.fancytrade.gui.front.commentaire;


import com.codename1.components.ImageViewer;
import com.codename1.components.InteractionDialog;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.gui.uikit.SideMenuBaseForm;
import com.fancytrade.services.CommentaireService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class AfficherToutCommentaire extends SideMenuBaseForm {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Commentaire currentCommentaire = null;
    Button addBtn;


    public AfficherToutCommentaire(Resources res) {
        super(new BoxLayout(BoxLayout.Y_AXIS));


        Toolbar tb = new Toolbar(true);
        tb.setUIID("CustomToolbar");
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Commentaire");
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

        ArrayList<Commentaire> listCommentaires = CommentaireService.getInstance().getAll();

        if (listCommentaires.size() > 0) {
            for (Commentaire commentaire : listCommentaires) {
                Component model = makeCommentaireModel(commentaire);
                this.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {
        addBtn.addActionListener(action -> {
            currentCommentaire = null;
            new AjouterCommentaire(this, null).show();
        });

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

    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makeCommentaireModel(Commentaire commentaire) {

        Container commentaireModel = makeModelWithoutButtons(commentaire);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");

        editBtn = new Button("Modifier");

        editBtn.addActionListener(action -> {
            currentCommentaire = commentaire;
            new ModifierCommentaire(this).show();
        });

        deleteBtn = new Button("Supprimer");

        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce commentaire ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = CommentaireService.getInstance().delete(commentaire.getId());

                if (responseCode == 200) {
                    currentCommentaire = null;
                    dlg.dispose();
                    commentaireModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du commentaire. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.EAST, deleteBtn);


        commentaireModel.add(btnsContainer);

        return commentaireModel;
    }
}