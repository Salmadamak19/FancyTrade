package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.Post;
import com.fancytrade.entities.User;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class PostService {

    public static PostService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Post> listPosts;

    private PostService() {
        cr = new ConnectionRequest();
    }

    public static PostService getInstance() {
        if (instance == null) {
            instance = new PostService();
        }
        return instance;
    }

    public ArrayList<Post> getAll() {
        listPosts = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/post");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listPosts = getList();
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

        return listPosts;
    }

    private ArrayList<Post> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                Post post = new Post(
                        (int) Float.parseFloat(obj.get("id").toString()),
                        makeUser((Map<String, Object>) obj.get("user")),
                        (String) obj.get("sujet"),
                        (String) obj.get("description"),
                        (int) Float.parseFloat(obj.get("nbrJaime").toString()),
                        (String) obj.get("image"),
                        new SimpleDateFormat("dd-MM-yyyy").parse((String) obj.get("date")),
                        (String) obj.get("communaute"),
                        (String) obj.get("analyse"),
                        (int) Float.parseFloat(obj.get("liked").toString()),
                        (int) Float.parseFloat(obj.get("badlevel").toString())
                );

                listPosts.add(post);
            }
        } catch (IOException | ParseException e) {
            e.printStackTrace();
        }
        return listPosts;
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

    public int add(Post post) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Post.jpg");

        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/post/add");

        try {
            cr.addData("file", post.getImage(), "image/jpeg");
        } catch (IOException e) {
            e.printStackTrace();
        }
        cr.addArgumentNoEncoding("image", post.getImage());

        cr.addArgumentNoEncoding("user", String.valueOf(post.getUser().getId()));
        cr.addArgumentNoEncoding("sujet", post.getSujet());
        cr.addArgumentNoEncoding("description", post.getDescription());
        cr.addArgumentNoEncoding("nbrJaime", String.valueOf(post.getNbrJaime()));
        cr.addArgumentNoEncoding("image", post.getImage());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(post.getDate()));
        cr.addArgumentNoEncoding("communaute", post.getCommunaute());
        cr.addArgumentNoEncoding("analyse", post.getAnalyse());
        cr.addArgumentNoEncoding("liked", String.valueOf(post.getLiked()));
        cr.addArgumentNoEncoding("badlevel", String.valueOf(post.getBadlevel()));

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

    public int edit(Post post, boolean imageEdited) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Post.jpg");

        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/post/edit");
        cr.addArgumentNoEncoding("id", String.valueOf(post.getId()));

        if (imageEdited) {
            try {
                cr.addData("file", post.getImage(), "image/jpeg");
            } catch (IOException e) {
                e.printStackTrace();
            }
        } else {
            cr.addArgumentNoEncoding("image", post.getImage());
        }

        cr.addArgumentNoEncoding("user", String.valueOf(post.getUser().getId()));
        cr.addArgumentNoEncoding("sujet", post.getSujet());
        cr.addArgumentNoEncoding("description", post.getDescription());
        cr.addArgumentNoEncoding("nbrJaime", String.valueOf(post.getNbrJaime()));
        cr.addArgumentNoEncoding("image", post.getImage());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(post.getDate()));
        cr.addArgumentNoEncoding("communaute", post.getCommunaute());
        cr.addArgumentNoEncoding("analyse", post.getAnalyse());
        cr.addArgumentNoEncoding("liked", String.valueOf(post.getLiked()));
        cr.addArgumentNoEncoding("badlevel", String.valueOf(post.getBadlevel()));

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

    public int delete(int postId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/post/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(postId));

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
