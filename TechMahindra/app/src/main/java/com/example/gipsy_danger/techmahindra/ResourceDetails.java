package com.example.gipsy_danger.techmahindra;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by gipsy_danger on 5/6/16.
 */
public class ResourceDetails extends ArrayAdapter {
    //MapFragment mp;
    ArrayList<String> name=new ArrayList<>();
    ArrayList<String> mobile=new ArrayList<>();
    SharedPreferences sharedPreferences;
    String urlParameters;
    Context con;



    // @SuppressWarnings("unchecked")
    String strl;

    public ResourceDetails(Context context, ArrayList<String> arrayList, ArrayList<String> resource) {
        super(context, R.layout.layout_for_resource,resource);
        con=context;
        sharedPreferences=con.getSharedPreferences("piyush",0);
        name=arrayList;
        mobile=resource;
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {


        LayoutInflater li= (LayoutInflater) con.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        convertView =li.inflate(R.layout.layout_for_resource,null);
        TextView tv= (TextView) convertView.findViewById(R.id.textView10);
        Button ib= (Button) convertView.findViewById(R.id.im);

        ib.setVisibility(View.VISIBLE);

        ib.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View v) {
               String us=sharedPreferences.getString("userName","0");
               String userMob=sharedPreferences.getString("mobile","0");
               String empMob=mobile.get(position);
               urlParameters="user="+us+"&userMob="+userMob+"&empMob="+empMob;
               Log.e("url",urlParameters);


           }
       });

        strl=name.get(position);
        tv.setText(name.get(position));

        if (position == 0) {
            convertView.setBackgroundColor(Color.parseColor("#ffa726"));
        }
        else if (position % 2 == 1) {
            convertView.setBackgroundColor(Color.parseColor("#009688"));
        }
        else if (position % 2 == 0) {
            convertView.setBackgroundColor(Color.parseColor("#26c6da"));
        }
        /*

        Addd othe attribute here..........................
         */
        ib.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
//                Intent in=new Intent(con, MapActivity.class);
//                in.putExtra("key",strl);
//                in.putExtra("key1",name.get(position)+""+strl);
//                con.startActivity(in);

            }
        });

        return convertView;
    }
}

