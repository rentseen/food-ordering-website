package com.yelinsheng.sender;

import com.yelinsheng.sender.R;

import java.util.ArrayList;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.TextView;

public class MyAdapter extends BaseAdapter {
    private ArrayList<String> list;
    private LayoutInflater mInflater;
  
    public MyAdapter(Context context, ArrayList<String> l) {
    	list = l;
		mInflater = LayoutInflater.from(context);
    }

    public int getCount() {
        return list.size();
    }

    public Object getItem(int position) {
        return list.get(position);
    }

    public long getItemId(int position) {
        return position;
    }

    public int getItemViewType(int position) {
        return position;
    }

    public View getView(int position, View convertView, ViewGroup parent) {
    	ViewHolder viewHolder = null;
    	String  item=list.get(position);
        if(convertView == null){
        	convertView = mInflater.inflate(R.layout.list_item, null);          
        	viewHolder=new ViewHolder(
        			(View) convertView.findViewById(R.id.list_child),
        			(TextView) convertView.findViewById(R.id.chat_msg)
        	       );
        	
        	convertView.setTag(viewHolder);
        	viewHolder.child.setBackgroundResource(R.drawable.shape);
        	
        }
        else{
        	if(!SenderActivity.submit.contains(SenderActivity.order.get(position))){
        		convertView=null;
        		convertView = mInflater.inflate(R.layout.list_item, null);          
            	viewHolder=new ViewHolder(
            			(View) convertView.findViewById(R.id.list_child),
            			(TextView) convertView.findViewById(R.id.chat_msg)
            	       );
            	
            	convertView.setTag(viewHolder);
            	viewHolder.child.setBackgroundResource(R.drawable.shape);
            	Log.w("testing","in");
        	}
        	else{
        		convertView=null;
        		convertView = mInflater.inflate(R.layout.list_item, null);          
            	viewHolder=new ViewHolder(
            			(View) convertView.findViewById(R.id.list_child),
            			(TextView) convertView.findViewById(R.id.chat_msg)
            	       );
            	convertView.setTag(viewHolder);
            	viewHolder.child.setBackgroundResource(R.drawable.choose);
            	Log.w("testing","out");
        	}
        }       
        
        viewHolder.msg.setText(item);    
        
        return convertView;
    }
    
    class ViewHolder {
    	  protected View child;
          protected TextView msg;
  
          public ViewHolder(View child, TextView msg){
              this.child = child;
              this.msg = msg;
              
          }
    }
    
}
