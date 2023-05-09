package com.fancytrade.gui.back.comment;


import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.fancytrade.entities.Comment;
import com.fancytrade.services.CommentService;

import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class AfficherToutComment extends Form {

    Form previous;

    public static Comment currentComment = null;


    public AfficherToutComment(Form previous) {
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


        ArrayList<Comment> listComments = CommentService.getInstance().getAll();


        if (listComments.size() > 0) {
            for (Comment comment : listComments) {
                Component model = makeCommentModel(comment);
                this.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {
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


    private Component makeCommentModel(Comment comment) {

        return makeModelWithoutButtons(comment);
    }

}