package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.ReclamationCategory;
import com.fancytrade.entities.Reclamations;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class ReclamationsService {

    public static ReclamationsService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Reclamations> listAnimals;

    

    private ReclamationsService() {
        cr = new ConnectionRequest();
    }

    public static ReclamationsService getInstance() {
        if (instance == null) {
            instance = new ReclamationsService();
        }
        return instance;
    }
    
    public ArrayList<Reclamations> getAll() {
        listAnimals = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URLf + "reclamation/All");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listAnimals = getList();
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

        return listAnimals;
    }

    private ArrayList<Reclamations> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                Reclamations Animals = new Reclamations(
                        (int) Float.parseFloat(obj.get("id").toString()),
                        
                        makeAnimalsCategory(
                        (Map<String, Object>) obj.get("category_id")),
                        1,
                        //(String) obj.get("category_id"),
                        //(int) obj.get("status"),
                        (String) obj.get("message")
                        
                );

                listAnimals.add(Animals);
            }
        } catch (IOException  e) {
            e.printStackTrace();
        }
        return listAnimals;
    }
    
    public ReclamationCategory makeAnimalsCategory(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        ReclamationCategory AnimalsCategory = new ReclamationCategory();
        AnimalsCategory.setId((int) Float.parseFloat(obj.get("id").toString()));
        //AnimalsCategory.setAnimalsCategory((String) obj.get("ReclamationCategory"));
        return AnimalsCategory;
    }
    
    public int add(Reclamations Animals) {
        return manage(Animals, false);
    }

    public int edit(Reclamations Animals) {
        return manage(Animals, true );
    }

    public int manage(Reclamations Animals, boolean isEdit) {
        
        cr = new ConnectionRequest();

        
        cr.setHttpMethod("POST");
        if (isEdit) {
            cr.setUrl(Statics.BASE_URLf + "reclamation/"+Animals.getId() + "/updateJSON?category_id="+Animals.getReclamationsCategory().getId()+"&message="+Animals.getMessage()+"&status="+Animals.getStatus());
           
        } else {
            cr.setUrl(Statics.BASE_URLf + "reclamation/newJson?category_id="+Animals.getReclamationsCategory().getId()+"&message="+Animals.getMessage()+"&status="+Animals.getStatus());
        }
        
        cr.addArgument("category_id", String.valueOf(Animals.getReclamationsCategory().getId()));
        cr.addArgument("status", String.valueOf(Animals.getStatus()));
        cr.addArgument("message", Animals.getMessage());
        
        
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

    public int delete(int AnimalsId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URLf + "reclamation/"+AnimalsId+"/del");
        cr.setHttpMethod("POST");
       

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
        }
        return cr.getResponseCode();
    }
}
