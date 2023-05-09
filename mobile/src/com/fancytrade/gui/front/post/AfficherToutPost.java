package com.fancytrade.gui.front.post;


import com.codename1.components.ImageViewer;
import com.codename1.components.InteractionDialog;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.entities.Post;
import com.fancytrade.gui.front.commentaire.AfficherToutCommentaire;
import com.fancytrade.gui.front.commentaire.AjouterCommentaire;
import com.fancytrade.gui.front.commentaire.ModifierCommentaire;
import com.fancytrade.gui.uikit.SideMenuBaseForm;
import com.fancytrade.services.CommentaireService;
import com.fancytrade.services.PostService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class AfficherToutPost extends SideMenuBaseForm {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Post currentPost = null;
    Button addBtn;

    public AfficherToutPost(Resources res) {
        super(new BoxLayout(BoxLayout.Y_AXIS));

        Toolbar tb = new Toolbar(true);
        tb.setUIID("CustomToolbar");
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Posts");
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


        ArrayList<Post> listPosts = PostService.getInstance().getAll();

        if (listPosts.size() > 0) {
            for (Post post : listPosts) {
                Component model = makePostModel(post);
                this.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {
        addBtn.addActionListener(action -> {
            currentPost = null;
            new AjouterPost(this).show();
        });

    }

    Label userLabel, sujetLabel, descriptionLabel, nbrJaimeLabel, imageLabel, dateLabel, communauteLabel, analyseLabel, likedLabel, badlevelLabel;

    ImageViewer imageIV;


    private Container makeModelWithoutButtons(Post post) {
        Container postModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        postModel.setUIID("containerRounded");


        userLabel = new Label("User : " + post.getUser());
        userLabel.setUIID("labelDefault");

        sujetLabel = new Label("Sujet : " + post.getSujet());
        sujetLabel.setUIID("labelDefault");

        descriptionLabel = new Label("Description : " + post.getDescription());
        descriptionLabel.setUIID("labelDefault");

        nbrJaimeLabel = new Label("NbrJaime : " + post.getNbrJaime());
        nbrJaimeLabel.setUIID("labelDefault");

        imageLabel = new Label("Image : " + post.getImage());
        imageLabel.setUIID("labelDefault");

        dateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(post.getDate()));
        dateLabel.setUIID("labelDefault");

        communauteLabel = new Label("Communaute : " + post.getCommunaute());
        communauteLabel.setUIID("labelDefault");

        analyseLabel = new Label("Analyse : " + post.getAnalyse());
        analyseLabel.setUIID("labelDefault");

        likedLabel = new Label("Liked : " + post.getLiked());
        likedLabel.setUIID("labelDefault");

        badlevelLabel = new Label("Badlevel : " + post.getBadlevel());
        badlevelLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + post.getUser().getEmail());
        userLabel.setUIID("labelDefault");

        if (post.getImage() != null) {
            String url = Statics.POST_IMAGE_URL + post.getImage();
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


        postModel.addAll(
                imageIV,
                userLabel, sujetLabel, descriptionLabel, nbrJaimeLabel, dateLabel, communauteLabel, analyseLabel, likedLabel, badlevelLabel
        );

        return postModel;
    }

    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makePostModel(Post post) {

        Container postModel = makeModelWithoutButtons(post);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");

        editBtn = new Button("Modifier");

        editBtn.addActionListener(action -> {
            currentPost = post;
            new ModifierPost(this).show();
        });

        deleteBtn = new Button("Supprimer");

        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce post ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = PostService.getInstance().delete(post.getId());

                if (responseCode == 200) {
                    currentPost = null;
                    dlg.dispose();
                    postModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du post. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });


        Button likeBTN = new Button("");
        likeBTN.setText(String.valueOf(post.getNbrJaime()));
        likeBTN.setUIID("likeButton");
        likeBTN.setMaterialIcon(FontImage.MATERIAL_FAVORITE);
        likeBTN.addActionListener(actionEvent -> {
            post.setNbrJaime(post.getNbrJaime() + 1);
            PostService.getInstance().edit(post, false);
            likeBTN.setText(String.valueOf(post.getNbrJaime()));
            this.refreshTheme();
        });

        btnsContainer.add(BorderLayout.WEST, likeBTN);
        btnsContainer.add(BorderLayout.CENTER, editBtn);
        btnsContainer.add(BorderLayout.EAST, deleteBtn);

        postModel.add(btnsContainer);

        ArrayList<Commentaire> listCommentaires = CommentaireService.getInstance().getAll();

        postModel.add(new Label("Commentaires : "));
        for (Commentaire commentaire : listCommentaires) {
            if (commentaire.getPost().getId() == post.getId()) {
                postModel.add(makeCommentaireModel(commentaire));
            }
        }

        Button addCommentButton = new Button("Ajouter un commentaire");
        addCommentButton.addActionListener(action -> {
            AfficherToutCommentaire.currentCommentaire = null;
            new AjouterCommentaire(this, post).show();
        });
        postModel.add(addCommentButton);

        return postModel;
    }

    Label commentaireUserLabel,
            commentairePostLabel,
            commentaireDescriptionLabel,
            commentaireDateLabel,
            commentaireAnalyseLabel,
            commentaireDatecTsLabel;

    ImageViewer commentaireImageIV;


    private Container makeModelWithoutButtons(Commentaire commentaire) {
        Container commentaireModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        commentaireModel.setUIID("containerRounded");


        commentaireUserLabel = new Label("User : " + commentaire.getUser());
        commentaireUserLabel.setUIID("labelDefault");

        commentairePostLabel = new Label("Post : " + commentaire.getPost());
        commentairePostLabel.setUIID("labelDefault");

        commentaireDescriptionLabel = new Label("Description : " + commentaire.getDescription());
        commentaireDescriptionLabel.setUIID("labelDefault");

        commentaireDateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDate()));
        commentaireDateLabel.setUIID("labelDefault");

        commentaireAnalyseLabel = new Label("Analyse : " + commentaire.getAnalyse());
        commentaireAnalyseLabel.setUIID("labelDefault");

        commentaireDatecTsLabel = new Label("DatecTs : " + new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDatecTs()));
        commentaireDatecTsLabel.setUIID("labelDefault");

        commentaireUserLabel = new Label("User : " + commentaire.getUser().getEmail());
        commentaireUserLabel.setUIID("labelDefault");

        commentairePostLabel = new Label("Post : " + commentaire.getPost().getSujet());
        commentairePostLabel.setUIID("labelDefault");

        if (commentaire.getImage() != null) {
            String url = Statics.COMMENTAIRE_IMAGE_URL + commentaire.getImage();
            Image image = URLImage.createToStorage(
                    EncodedImage.createFromImage(theme.getImage("user-picture.jpg").fill(1100, 500), false),
                    url,
                    url,
                    URLImage.RESIZE_SCALE
            );
            commentaireImageIV = new ImageViewer(image);
        } else {
            commentaireImageIV = new ImageViewer(theme.getImage("user-picture.jpg").fill(1100, 500));
        }
        commentaireImageIV.setFocusable(false);

        commentaireModel.addAll(
                commentaireImageIV,
                commentaireUserLabel, commentairePostLabel, commentaireDescriptionLabel, commentaireDateLabel, commentaireAnalyseLabel, commentaireDatecTsLabel
        );

        return commentaireModel;
    }

    Button commentaireEditBtn, commentaireDeleteBtn;
    Container commentaireBtnsContainer;

    private Component makeCommentaireModel(Commentaire commentaire) {

        Container commentaireModel = makeModelWithoutButtons(commentaire);

        commentaireBtnsContainer = new Container(new BorderLayout());
        commentaireBtnsContainer.setUIID("containerButtons");

        commentaireEditBtn = new Button("Modifier");

        commentaireEditBtn.addActionListener(action -> {
            AfficherToutCommentaire.currentCommentaire = commentaire;
            new ModifierCommentaire(this).show();
        });

        commentaireDeleteBtn = new Button("Supprimer");
        commentaireDeleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce commentaire ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = CommentaireService.getInstance().delete(commentaire.getId());

                if (responseCode == 200) {
                    AfficherToutCommentaire.currentCommentaire = null;
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

        commentaireBtnsContainer.add(BorderLayout.WEST, commentaireEditBtn);
        commentaireBtnsContainer.add(BorderLayout.EAST, commentaireDeleteBtn);


        commentaireModel.add(commentaireBtnsContainer);

        return commentaireModel;
    }
}