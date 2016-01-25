class CreateEvents < ActiveRecord::Migration
  def change
    create_table :events do |t|
      t.integer :event_id
      t.integer :user_id
      t.string :title
      t.text :description
      t.timestamp :start_time
      t.timestamp :end_time
      t.string :cost
      t.text :more_info
      t.string :owner
      t.string :ticket_uri
      t.boolean :is_grid_event
      t.float :longitude
      t.float :latitude

      t.timestamps null: false
    end
  end
end
