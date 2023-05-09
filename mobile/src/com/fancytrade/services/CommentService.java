package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.Comment;
import com.fancytrade.entities.Publication;
import com.fancytrade.entities.User;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class CommentService {

    public static CommentService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Comment> listComments;


    private CommentService() {
        cr = new ConnectionRequest();
    }

    public static CommentService getInstance() {
        if (instance == null) {
            instance = new CommentService();
        }
        return instance;
    }

    public ArrayList<Comment> getAll() {
        listComments = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/comment");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listComments = getList();
                }

                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return listComments;
    }

    private ArrayList<Comment> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                Comment comment = new Comment(
                        (int) Float.parseFloat(obj.get("id").toString()),

                        makePublication((Map<String, Object>) obj.get("publication")),
                        makeUser((Map<String, Object>) obj.get("user")),
                        (String) obj.get("content"),
                        new SimpleDateFormat("dd-MM-yyyy").parse((String) obj.get("date"))

                );

                listComments.add(comment);
            }
        } catch (IOException | ParseException e) {
            e.printStackTrace();
        }
        return listComments;
    }

    public Publication makePublication(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        Publication publication = new Publication();
        publication.setId((int) Float.parseFloat(obj.get("id").toString()));
        publication.setContent((String) obj.get("content"));
        return publication;
    }

    public User makeUser(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        User user = new User();
        user.setId((int) Float.parseFloat(obj.get("id").toString()));
        user.setEmail((String) obj.get("email"));
        return user;
    }

    public int add(Comment comment) {

        cr = new ConnectionRequest();

        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/comment/add");

        cr.addArgument("publication", String.valueOf(comment.getPublication().getId()));
        cr.addArgument("user", String.valueOf(comment.getUser().getId()));
        cr.addArgument("content", comment.getContent());
        cr.addArgument("date", new SimpleDateFormat("dd-MM-yyyy").format(comment.getDate()));


        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultCode = cr.getResponseCode();
                cr.removeResponseListener(this);
            }
        });
        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {

        }
        return resultCode;
    }

    public int edit(Comment comment) {

        cr = new ConnectionRequest();
        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/comment/edit");
        cr.addArgument("id", String.valueOf(comment.getId()));

        cr.addArgument("publication", String.valueOf(comment.getPublication().getId()));
        cr.addArgument("user", String.valueOf(comment.getUser().getId()));
        cr.addArgument("content", comment.getContent());
        cr.addArgument("date", new SimpleDateFormat("dd-MM-yyyy").format(comment.getDate()));


        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultCode = cr.getResponseCode();
                cr.removeResponseListener(this);
            }
        });
        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {

        }
        return resultCode;
    }

    public int delete(int commentId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/comment/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(commentId));

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return cr.getResponseCode();
    }
}
