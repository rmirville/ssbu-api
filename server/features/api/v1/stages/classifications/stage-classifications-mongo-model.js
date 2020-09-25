const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const stageClassificationsMongoSchema = new Schema({
  gameName: {
    type: String,
    required: [true, 'gameName is required'],
  },
  name: {
    type: String,
    required: [true, 'name is required'],
    unique: true
  },
  abbr: {
    type: String,
    required: [true, 'abbr is required'],
  },
  series: {
    type: String,
    required: [true, 'series is required'],
  },
  tourneyPresence: {
    type: Number,
    required: [true, 'tourneyPresence is required'],
  }
}, {
  collection: 'stage_classifications'
});
stageClassificationsMongoSchema.index({gameName: 1});

const StageClassificationsMongoModel = mongoose.model('StageClassifications', stageClassificationsMongoSchema)

module.exports = StageClassificationsMongoModel;
