/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import DB.Database;
import Entities.Commentaire;
import Entities.categorie;
import Entities.Poste;
import entities.User;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author azyz
 */
public class ServicePoste implements Iservice1<Poste> {
    
     Connection cnx = Database.getInstance().getCon();
     
     @Override
    public void ajouter(Poste w) {
        try {
           
            String req = "INSERT INTO poste (titre, description,img,categorie,date,id_user) VALUES ('" + w.getTitre() + "', '" + w.getDesc() + "','" + w.getImg() + "','" +w.getCategorie().getNom()+"','"+w.getDate()+"','"+w.getUser().getId()+"')";
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Poste created !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    @Override
    public void supprimer(int id) {
        try {
            String req = "DELETE FROM poste  WHERE id = " + id;
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Poste deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    @Override
    public void modifier(Poste w) {
        try {
            String req = "UPDATE Poste SET Titre = '" + w.getTitre() + "', description = '" + w.getDesc() + "',img = '" + w.getImg() + "',categorie ='"+w.getCategorie().getNom()+"',date ='"+w.getDate()+"',id_user='"+w.getUser().getId()+"' WHERE Poste.id = " + w.getId();
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Poste updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    @Override
    public List<Poste> getAll() {
        List<Poste> list = new ArrayList<>();
        try {
            String req = "Select * from Poste";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                categorie d;
                User u;
                ServiceUser ss = new ServiceUser();
                ServiceCategorie dd = new ServiceCategorie();
                d = dd.getOneByName(rs.getString("categorie"));
                u = ss.ChercherParId(rs.getInt(7));
                Poste w = new Poste(rs.getInt(1), rs.getString("Titre"), rs.getString("description"),rs.getString("img"),d,rs.getDate("date"),u);
                list.add(w);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
    public List<Poste> getAll(String titre) {
        List<Poste> list = new ArrayList<>();
        try {
             PreparedStatement p = cnx.prepareStatement("Select * from poste  WHERE poste.titre LIKE ?");
            p.setString(1,"%"+titre+"%");
             ResultSet rs = p.executeQuery();
            while (rs.next()) {
                categorie d;
                User u;
                ServiceUser ss = new ServiceUser();
                ServiceCategorie dd = new ServiceCategorie();
                d = dd.getOneByName(rs.getString("categorie"));
                u = ss.ChercherParId(rs.getInt(7));
                Poste w = new Poste(rs.getInt(1), rs.getString("Titre"), rs.getString("description"),rs.getString("img"),d,rs.getDate("date"),u);
                list.add(w);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
    public List<Poste> getAllT(String domaine) {
        List<Poste> list = new ArrayList<>();
        try {
             PreparedStatement p = cnx.prepareStatement("Select * from poste  WHERE poste.categorie LIKE ?");
            p.setString(1,"%"+domaine+"%");
             ResultSet rs = p.executeQuery();
            while (rs.next()) {
                categorie d;
                User u;
                ServiceUser ss = new ServiceUser();
                ServiceCategorie dd = new ServiceCategorie();
                d = dd.getOneByName(rs.getString("categorie"));
                u = ss.ChercherParId(rs.getInt(7));
                Poste w = new Poste(rs.getInt(1), rs.getString("Titre"), rs.getString("description"),rs.getString("img"),d,rs.getDate("date"),u);
                list.add(w);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
    
    
    public List<Poste> getAll(int id) {
        List<Poste> list = new ArrayList<>();
        try {
            String req = "Select * from Poste WHERE Poste.id_user ="+id+"";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                categorie d;
                User u;
                ServiceUser ss = new ServiceUser();
                ServiceCategorie dd = new ServiceCategorie();
                d = dd.getOneByName(rs.getString("categorie"));
                u = ss.ChercherParId(rs.getInt(7));
                Poste w = new Poste(rs.getInt(1), rs.getString("Titre"), rs.getString("description"),rs.getString("img"),d,rs.getDate("date"),u);
                list.add(w);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
     @Override
    public Poste getOneById(int id) {
        Poste w = null;
        try {
            String req = "Select * from Poste WHERE poste.id = "+id+"";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while (rs.next()) {
                User u;
                categorie d;
                ServiceCategorie dd = new ServiceCategorie();
                ServiceUser ss = new ServiceUser();
                d = dd.getOneByName(rs.getString("categorie"));
                u = ss.ChercherParId(rs.getInt(7));
                  w = new Poste(rs.getInt(1), rs.getString("Titre"), rs.getString("description"),rs.getString("img"),d,rs.getDate("date"),u);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return w;
    }
public int comments (int id){
    ServicePoste sp = new ServicePoste();
    ServiceUser su = new ServiceUser();
        List<Commentaire> posts = new ArrayList<>();
        try {
            String req = "select * from commentaire where id_poste = " +id+"";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);

            while (rs.next()) {
                Commentaire p = new Commentaire();
                p.setId(rs.getInt("id"));
                p.setDesc(rs.getString("description"));
               
                p.setDate(rs.getDate("date"));
                p.setPoste(sp.getOneById(rs.getInt("id_poste")));
                p.setUser(su.ChercherParId(rs.getInt("id")));
               posts.add(p);
            }
           

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return posts.size(); 
    }
     
    
}
