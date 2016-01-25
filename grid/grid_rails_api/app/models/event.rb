# == Schema Information
#
# Table name: events
#
#  id            :integer          not null, primary key
#  event_id      :integer
#  user_id       :integer
#  title         :string
#  description   :text
#  start_time    :datetime
#  end_time      :datetime
#  cost          :string
#  more_info     :text
#  owner         :string
#  ticket_uri    :string
#  is_grid_event :boolean
#  longitude     :float
#  latitude      :float
#  created_at    :datetime         not null
#  updated_at    :datetime         not null
#

class Event < ActiveRecord::Base
  
end
