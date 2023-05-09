package com.fancytrade.gui.front.comment;


import com.codename1.components.InteractionDialog;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Comment;
import com.fancytrade.gui.uikit.SideMenuBaseForm;
import com.fancytrade.services.CommentService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutComment extends SideMenuBaseForm {

    Form previous;

    public static Comment currentComment = null;
    Button addBtn;

    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public AfficherToutComment(Resources res) {
        super(new BoxLayout(BoxLayout.Y_AXIS));

        Toolbar tb = new Toolbar(true);
        tb.setUIID("CustomToolbar");
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Comment");
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


        ArrayList<Comment> listComments = CommentService.getInstance().getAll();

        componentModels = new ArrayList<>();

        sortPicker = PickerComponent.createStrings("Publication", "User", "Content", "Date").label("Trier par");
        sortPicker.getPicker().setSelectedString("");
        sortPicker.getPicker().addActionListener((l) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            Statics.compareVar = sortPicker.getPicker().getSelectedString();
            Collections.sort(listComments);
            for (Comment comment : listComments) {
                Component model = makeCommentModel(comment);
                this.add(model);
                componentModels.add(model);
            }
            this.revalidate();
        });
        this.add(sortPicker);

        if (listComments.size() > 0) {
            for (Comment comment : listComments) {
                Component model = makeCommentModel(comment);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {
        addBtn.addActionListener(action -> {
            currentComment = null;
            new AjouterComment(this, null).show();
        });

    }

    Label publicationLabel, userLabel, contentLabel, dateLabel;


    private Container makeModelWithoutButtons(Comment comment) {
        Container commentModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        commentModel.setUIID("containerRounded");


        publicationLabel = new Label("Publication : " + comment.getPublication());
        publicationLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + comment.getUser());
        userLabel.setUIID("labelDefault");

        contentLabel = new Label("Content : " + comment.getContent());
        contentLabel.setUIID("labelDefault");

        dateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(comment.getDate()));
        dateLabel.setUIID("labelDefault");

        publicationLabel = new Label("Publication : " + comment.getPublication().getContent());
        publicationLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + comment.getUser().getEmail());
        userLabel.setUIID("labelDefault");


        commentModel.addAll(

                publicationLabel, userLabel, contentLabel, dateLabel
        );

        return commentModel;
    }

    Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makeCommentModel(Comment comment) {

        Container commentModel = makeModelWithoutButtons(comment);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");

        editBtn = new Button("Modifier");

        editBtn.addActionListener(action -> {
            currentComment = comment;
            new ModifierComment(this).show();
        });

        deleteBtn = new Button("Supprimer");

        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce comment ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = CommentService.getInstance().delete(comment.getId());

                if (responseCode == 200) {
                    currentComment = null;
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

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.EAST, deleteBtn);


        commentModel.add(btnsContainer);

        return commentModel;
    }


}